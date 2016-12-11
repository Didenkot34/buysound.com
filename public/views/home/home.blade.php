<h1>Hello from home</h1>
<h1>{{groups}}</h1>
<h3>Create Group</h3>
<form role="form">
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" ng-model="group.name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" id="slug" ng-model="group.slug" placeholder="Enter slug">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" ng-model="group.description" placeholder="Enter description">
    </div>
    <button type="submit" class="btn btn-default" ng-click="createGroup(group)">Submit</button>
</form>