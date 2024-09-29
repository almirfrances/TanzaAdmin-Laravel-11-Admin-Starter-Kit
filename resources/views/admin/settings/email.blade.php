@extends('admin.layouts.admin')

@section('title', $title)

@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="mb-4">{{ $title }}</h4>
    <p class="mb-4">
        Configure the email settings for your application. You can choose between the default PHP mailer or an SMTP server for sending emails. You can also customize the global email template used across all emails in the application.
    </p>

    <!-- Tabs for Email Settings and Email Template -->
    <ul class="nav nav-tabs mb-4" id="emailSettingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="email-config-tab" data-bs-toggle="tab" href="#email-config" role="tab" aria-controls="email-config" aria-selected="true">Email Configuration</a>
        </li>
        {{-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="email-template-tab" data-bs-toggle="tab" href="#email-template" role="tab" aria-controls="email-template" aria-selected="false">Email Template</a>
        </li> --}}
    </ul>

    <div class="tab-content" id="emailSettingsTabsContent">
        <!-- Email Configuration Tab -->
        <div class="tab-pane fade show active" id="email-config" role="tabpanel" aria-labelledby="email-config-tab">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.email.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="email_method" class="form-label">Email Sending Method</label>
                                        <select id="email_method" name="email_method" class="form-select">
                                            <option value="phpmailer" {{ old('email_method', $settings['email_method'] ?? 'phpmailer') == 'phpmailer' ? 'selected' : '' }}>Default PHP Mailer</option>
                                            <option value="smtp" {{ old('email_method', $settings['email_method'] ?? '') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                        </select>
                                        <small class="text-muted">Choose the method for sending emails from your application.</small>
                                    </div>
                                </div>

                                <div id="smtp-settings" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="smtp_host" class="form-label">SMTP Host</label>
                                            <input type="text" id="smtp_host" name="smtp_host" class="form-control" placeholder="e.g., smtp.example.com" value="{{ old('smtp_host', $settings['smtp_host'] ?? '') }}">
                                            <small class="text-muted">The address of your SMTP server (e.g., smtp.gmail.com).</small>
                                        </div>

                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="smtp_port" class="form-label">SMTP Port</label>
                                            <input type="number" id="smtp_port" name="smtp_port" class="form-control" placeholder="e.g., 587" value="{{ old('smtp_port', $settings['smtp_port'] ?? '') }}">
                                            <small class="text-muted">The port your SMTP server uses (e.g., 587 for TLS, 465 for SSL).</small>
                                        </div>

                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="smtp_username" class="form-label">SMTP Username</label>
                                            <input type="text" id="smtp_username" name="smtp_username" class="form-control" placeholder="e.g., your-email@example.com" value="{{ old('smtp_username', $settings['smtp_username'] ?? '') }}">
                                            <small class="text-muted">Your SMTP account's username (usually your email address).</small>
                                        </div>

                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="smtp_password" class="form-label">SMTP Password</label>
                                            <input type="password" id="smtp_password" name="smtp_password" class="form-control" placeholder="••••••••" value="{{ old('smtp_password', $settings['smtp_password'] ?? '') }}">
                                            <small class="text-muted">Your SMTP account's password.</small>
                                        </div>

                                        <div class="col-md-12 col-12 mb-3">
                                            <label for="smtp_encryption" class="form-label">SMTP Encryption</label>
                                            <select id="smtp_encryption" name="smtp_encryption" class="form-select">
                                                <option value="none" {{ old('smtp_encryption', $settings['smtp_encryption'] ?? 'none') == 'none' ? 'selected' : '' }}>None</option>
                                                <option value="ssl" {{ old('smtp_encryption', $settings['smtp_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                                <option value="tls" {{ old('smtp_encryption', $settings['smtp_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                            </select>
                                            <small class="text-muted">The encryption method your SMTP server uses (usually SSL or TLS).</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="smtp_from_email" class="form-label">From Email Address</label>
                                        <input type="email" id="smtp_from_email" name="smtp_from_email" class="form-control" placeholder="e.g., no-reply@example.com" value="{{ old('smtp_from_email', $settings['smtp_from_email'] ?? '') }}">
                                        <small class="text-muted">The email address that will appear as the sender of the emails.</small>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="smtp_from_name" class="form-label">From Name</label>
                                        <input type="text" id="smtp_from_name" name="smtp_from_name" class="form-control" placeholder="e.g., Your Company Name" value="{{ old('smtp_from_name', $settings['smtp_from_name'] ?? '') }}">
                                        <small class="text-muted">The name that will appear as the sender of the emails.</small>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save Email Settings</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Warnings, Tips, and Test Email Card -->
                <div class="col-md-4 col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Important Tips</h5>
                            <div id="warnings">
                                <p class="card-text text-danger"><strong>Ensure the SMTP credentials are correct.</strong> Incorrect credentials can cause emails to fail.</p>
                                <p class="card-text"><strong>Use secure ports.</strong> For SSL, use port 465. For TLS, use port 587.</p>
                                <p class="card-text"><strong>Check your server's firewall.</strong> Ensure the SMTP port is open on your server.</p>
                                <p class="card-text"><strong>Verify the 'From' email.</strong> Some SMTP servers require the 'From' email to match the authenticated email address.</p>
                            </div>

                            <h5 class="card-title mt-4">Test Email Settings</h5>
                            <form method="POST" action="{{ route('admin.settings.email.test') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="test_email" class="form-label">Test Email Address</label>
                                    <input type="email" id="test_email" name="test_email" class="form-control" placeholder="e.g., test@example.com">
                                    <small class="text-muted">Enter an email address to send a test email.</small>
                                </div>
                                <button type="submit" class="btn btn-success">Send Test Email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Template Tab -->
        {{-- <div class="tab-pane fade" id="email-template" role="tabpanel" aria-labelledby="email-template-tab">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.email.template.update') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email_template" class="form-label">Email Template</label>
                                    <textarea id="email_template" name="email_template" class="form-control html-editor" rows="10">{{ old('email_template', $settings['email_template'] ?? '') }}</textarea>
                                    <small class="text-muted">Customize the global email template. Use <code> $message </code> to insert dynamic email content.</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Save Email Template</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<script>
    document.getElementById('email_method').addEventListener('change', function () {
        var smtpSettings = document.getElementById('smtp-settings');
        var warnings = document.getElementById('warnings');
        if (this.value === 'smtp') {
            smtpSettings.style.display = 'block';
            warnings.innerHTML = `
                <p class="card-text text-danger"><strong>Ensure the SMTP credentials are correct.</strong> Incorrect credentials can cause emails to fail.</p>
                <p class="card-text"><strong>Use secure ports.</strong> For SSL, use port 465. For TLS, use port 587.</p>
                <p class="card-text"><strong>Check your server's firewall.</strong> Ensure the SMTP port is open on your server.</p>
                <p class="card-text"><strong>Verify the 'From' email.</strong> Some SMTP servers require the 'From' email to match the authenticated email address.</p>
            `;
        } else {
            smtpSettings.style.display = 'none';
            warnings.innerHTML = `
                <p class="card-text text-danger"><strong>Default PHP Mailer is less configurable.</strong> Consider using SMTP for more control and reliability.</p>
                <p class="card-text"><strong>Mail delivery might be slower.</strong> The default PHP Mailer relies on your server's configuration.</p>
                <p class="card-text"><strong>SMTP is recommended.</strong> For better deliverability, use an SMTP server.</p>
            `;
        }
    });

    // Initialize visibility based on the current setting
    document.getElementById('email_method').dispatchEvent(new Event('change'));

    // Initialize TinyMCE editor
    tinymce.init({
        selector: '.html-editor',
        height: 300,
        plugins: 'image link media code',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image media link | code',
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true
    });
</script>
@endsection
