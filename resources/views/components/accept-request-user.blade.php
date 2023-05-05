<div class="d-flex justify-content-center">
    <div class="pr-4">
        <form action="' . route("connection.edit", $connection->id) . '">
        <button class="btn btn-success">Accept</button>
        </form>
    </div>
    <div>
        <button class="btn btn-danger">Denied</button>
    </div>
</div>
