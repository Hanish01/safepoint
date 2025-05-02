<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Complaint Resolved - SAFE POINT</title>
</head>
<body>
    <h2>Your complaint has been resolved</h2>
    <p>Dear {{ $complaint->user->name ?? 'User' }},</p>
    <p>Your complaint with the following details has been marked as resolved:</p>
    <p><strong>Description:</strong> {{ $complaint->description }}</p>
    <p><strong>Admin Comment:</strong> {{ $complaint->admin_comment }}</p>
    <p>Thank you for using SAFE POINT.</p>
</body>
</html>
