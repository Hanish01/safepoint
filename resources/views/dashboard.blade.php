<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SAFE POINT Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .dashboard-header {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            font-weight: bold;
        }
        .cards-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        .card-total {
            background-color: #007bff;
            color: white;
        }
        .card-resolved {
            background-color: #28a745;
            color: white;
        }
        .card-unresolved {
            background-color: #dc3545;
            color: white;
        }
        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        .security-text {
            max-width: 600px;
            margin: 0 auto 40px auto;
            text-align: center;
            font-size: 1.1rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header">SAFE POINT Dashboard</div>
        <div class="cards-container">
            <div class="card card-total text-center p-4" style="width: 18rem;">
                <h5>Total Complaints</h5>
                <h2>{{ $totalComplaints }}</h2>
            </div>
            <div class="card card-resolved text-center p-4" style="width: 18rem;">
                <h5>Resolved Complaints</h5>
                <h2>{{ $resolvedComplaints }}</h2>
            </div>
            <div class="card card-unresolved text-center p-4" style="width: 18rem;">
                <h5>Unresolved Complaints</h5>
                <h2>{{ $unresolvedComplaints }}</h2>
            </div>
        </div>
        <div class="security-text">
            <p>
                At SAFE POINT, your security is our top priority. Our platform ensures that all complaints are handled with utmost confidentiality and integrity. We are committed to providing a safe and secure environment for all users.
            </p>
        </div>
        <div class="buttons-container">
            <a href="{{ route('incident.form') }}" class="btn btn-primary btn-lg">Incident Reporting</a>
            <a href="{{ route('incident.reports') }}" class="btn btn-secondary btn-lg">Showing Reporting</a>
            <a href="{{ route('admin.login.form') }}" class="btn btn-danger btn-lg">Admin Login</a>
        </div>
    </div>
</body>
</html>
