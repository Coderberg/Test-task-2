<div class="text-right mb-3">

    <div class="btn-group" role="group">
        <button id="btnGroupDrop1"
                type="button"
                class="btn btn-light dropdown-toggle"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
            Sort
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="?order_by=name">by name A-Z</a>
            <a class="dropdown-item" href="?order_by=name_desc">by name Z-A</a>
            <a class="dropdown-item" href="?order_by=email">by email A-Z</a>
            <a class="dropdown-item" href="?order_by=email_desc">by email Z-A</a>
            <a class="dropdown-item" href="?order_by=status">by status</a>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
        <i class="fas fa-plus"></i> Add Task
    </button>

</div>
