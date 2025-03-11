<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assigned Project List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Assigned Project List</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Project Code</th>
                    <th>Project Name</th>
                    <th>Student Reg Number</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->project_code }}</td>
                    <td>{{ $project->project_name }}</td>
                    <td>{{ $project->student_reg_number }}</td>
                    <td>{{ $project->comment }}</td>
                    <td>{{ $project->status }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->project_code) }}" class="btn btn-primary">View</a>

                        <!-- Button to trigger modal -->
                        <button class="btn btn-success" onclick="openModal('{{ $project->project_code }}', 'approve')">Approve</button>
                        <button class="btn btn-danger" onclick="openModal('{{ $project->project_code }}', 'reject')">Reject</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Approve/Reject Modal -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Project Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="projectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="status" id="modalStatus">
                        <input type="hidden" name="project_code" id="modalProjectCode">
                        <label for="comment" class="form-label">Comment:</label>
                        <textarea class="form-control" name="comment" id="modalComment" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(projectCode, action) {
            document.getElementById("modalProjectCode").value = projectCode;
            document.getElementById("modalStatus").value = action === 'approve' ? 'Approved' : 'Rejected';
            document.getElementById("projectForm").action = action === 'approve'
                ? "/projects/" + projectCode + "/approved"
                : "/projects/" + projectCode + "/rejected";

            document.getElementById("projectModalLabel").innerText = action === 'approve' ? 'Approve Project' : 'Reject Project';
            var myModal = new bootstrap.Modal(document.getElementById('projectModal'));
            myModal.show();
        }
    </script>

</body>
</html>
