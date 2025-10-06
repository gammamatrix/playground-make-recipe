<?php
$user = \Illuminate\Support\Facades\Auth::user();

$viewForm = true;
//$viewPeople = \Playground\Auth\Facades\Can::access($user, [
//    "allow" => false,
//    "any" => true,
//    "privilege" => "playground-crm-resource:people:viewAny",
//    "roles" => ["admin", "manager", "publisher"],
//])->allowed();

//if (! $viewForm) {
//    return;
//}
?>

<div class="card my-1">
    <div class="card-body">
        <h2>Make</h2>

        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Recipes
                        <small class="text-muted">recipe management</small>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if ($viewForm)
                            <a
                                href="{{ route("playground.make.recipe") }}"
                                class="list-group-item list-group-item-action"
                            >
                                Make Recipe
                            </a>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
