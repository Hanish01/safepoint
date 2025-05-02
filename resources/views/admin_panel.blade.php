<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Panel - SAFE POINT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .admin-header {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            font-weight: bold;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .table-container {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="{{ route('admin.logout') }}" class="logout-btn">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        <div class="admin-header">Admin Panel - Incident Reports</div>
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Admin Comment</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                    <tr>
                        <td>{{ $complaint->id }}</td>
                        <td>{{ $complaint->user_id }}</td>
                        <td>{{ $complaint->description }}</td>
                        <td>{{ ucfirst($complaint->status) }}</td>
                        <td>{{ $complaint->admin_comment ?? '-' }}</td>
                        <td>{{ $complaint->created_at }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.complaint.delete', $complaint->id) }}" onsubmit="return confirm('Are you sure you want to delete this complaint?');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            @if($complaint->status !== 'resolved')
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#resolveModal" data-complaint-id="{{ $complaint->id }}" data-complaint-desc="{{ $complaint->description }}">
                                Resolve
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @if($complaints->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No complaints found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Resolve Modal -->
    <div class="modal fade" id="resolveModal" tabindex="-1" aria-labelledby="resolveModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.complaint.resolve') }}">
            @csrf
            <input type="hidden" name="complaint_id" id="complaint_id" />
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="resolveModalLabel">Resolve Complaint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p id="complaint_description"></p>
                <div class="mb-3">
                    <label for="admin_comment" class="form-label">Admin Comment</label>
                    <textarea class="form-control" id="admin_comment" name="admin_comment" rows="4" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send & Resolve</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var resolveModal = document.getElementById('resolveModal');
        resolveModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var complaintId = button.getAttribute('data-complaint-id');
            var complaintDesc = button.getAttribute('data-complaint-desc');

            var modalComplaintId = resolveModal.querySelector('#complaint_id');
            var modalComplaintDesc = resolveModal.querySelector('#complaint_description');

            modalComplaintId.value = complaintId;
            modalComplaintDesc.textContent = complaintDesc;
        });
    </script>
</body>
</html>
