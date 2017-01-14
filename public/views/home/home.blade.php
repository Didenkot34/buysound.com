<!-- TODO: Replace table to table component when https://github.com/angular/material/issues/796 will closed -->
<div class="table-responsive-vertical md-whiteframe-z1">
    <table id="table" class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Issue</th>
            <th>Status</th>
            <th>Progress</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="group in groups track by $index">
            <td data-title="ID">{{$index + 1}}</td>
            <td data-title="Issue">{{group.name}}</td>
            <td data-title="Status">{{groups.status}}</td>
            <td data-title="Progress">
                <md-progress-linear class="table-progress "
                                    md-mode="determinate"
                                    value=10>
                </md-progress-linear>
            </td>
        </tr>
        </tbody>
    </table>
</div>
