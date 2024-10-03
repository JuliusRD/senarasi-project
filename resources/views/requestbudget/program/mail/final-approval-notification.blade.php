<!DOCTYPE html>
<html>
<head>
    <title>Final Approval Notification</title>
</head>
<body>
    <h1>Final Approval Completed</h1>
    <p>Dear {{ $requestBudget->employee->full_name }},</p>
    <p>Your budget request has been fully approved.</p>
    <p><strong>Request ID:</strong> {{ $requestBudget->request_budget_id }}</p>
    <p><strong>Budget:</strong> {{ $requestBudget->budget }}</p>
    <p><strong>Total Cost:</strong> {{ $totalAll }}</p>

    <p>Thank you for your submission, and congratulations on the successful approval!</p>
</body>
</html>