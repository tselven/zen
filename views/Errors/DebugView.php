<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($errorMessage ?? 'Unknown Error Occurred'); ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .debug-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .debug-container:hover {
            transform: translateY(-4px);
        }
        .error-header {
            color: #dc3545;
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
        }
        .error-header i {
            margin-right: 8px;
            font-size: 2rem;
        }
        .stack-trace pre {
            background-color: #343a40;
            color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            line-height: 1.5;
            white-space: pre-wrap;
            word-wrap: break-word;
            overflow-x: auto;
        }
        .stack-trace h4 {
            font-size: 1.125rem;
            color: #ffffff;
            margin-bottom: 0.75rem;
        }
        .debug-info ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 1rem;
        }
        .debug-info ul li {
            background-color: #f8f9fa;
            margin: 5px 0;
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .debug-info ul li strong {
            color: #007bff;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 0.375rem;
            padding: 8px 16px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="debug-container bg-dark">
            <div class="text-center">
                <h1 class="error-header">
                    <i class="bi bi-bug-fill"></i> Debug Information
                </h1>
                <p class="lead text-danger" style="margin-bottom: 1rem;">Oops! Something went wrong. Below are the details:</p>
            </div>

            <!-- Error Message -->
            <p class="text-muted alert alert-danger" style="margin-bottom: 1rem;">
                <b> <?= htmlspecialchars($errorMessage ?? 'No error message provided'); ?> </b?
            </p>

            <!-- Stack Trace -->
            <div class="stack-trace">
                <h4>Stack Trace</h4>
                <pre class="border border-2"><?= $stackTrace ?? 'No stack trace available' ?></pre>
            </div>

            <!-- Debug Information -->
            <h4>Request Details</h4>
            <div class="debug-info">
                <ul>
                    <li><strong>Request Method:</strong> <?= htmlspecialchars($_SERVER['REQUEST_METHOD'] ?? 'N/A'); ?></li>
                    <li><strong>Request URI:</strong> <?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? 'N/A'); ?></li>
                    <li><strong>Source IP:</strong> <?= htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? 'N/A'); ?></li>
                    <li><strong>User Agent:</strong> <?= htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? 'N/A'); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>