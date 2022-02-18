<div class="modal" id="todo-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Todo</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="todo-modal-close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form method="post" action="{{ route('todos-store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" required name="title"  placeholder="Title">
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="text" class="form-control" autocomplete="off" name="deadline" required id="deadline" placeholder="Deadline">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        </div>
        </div>
    </div>
</div>
