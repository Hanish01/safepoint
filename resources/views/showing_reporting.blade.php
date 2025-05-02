<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Showing Reporting - SAFE POINT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center text-primary">Your Incident Reports</h2>
        @if($complaints->isEmpty())
            <div class="alert alert-info">No incident reports found.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Reported At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->description }}</td>
                            <td>
                                @if($complaint->status === 'resolved')
                                    <span class="badge bg-success">Resolved</span>
                                @else
                                    <span class="badge bg-danger">Unresolved</span>
                                @endif
                            </td>
                            <td>{{ $complaint->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="mt-3">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
