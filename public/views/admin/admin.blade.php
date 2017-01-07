<h1>Hello from Admin</h1>

<h3>Create Group</h3>

<md-content layout-padding>
    <form name="projectForm">

        <div layout="row">
            <md-input-container flex="40">
                <label>Название Группы</label>
                <input required name="name" ng-model="group.name">
                <div ng-messages="projectForm.name.$error">
                    <div ng-message="required">This is required.</div>
                </div>
            </md-input-container>

            <md-input-container flex="40">
                <label>Рейтинг</label>
                <md-select name="rating" ng-model="group.rating" required>
                    <md-option value="1">Высокий</md-option>
                    <md-option value="2">Средний</md-option>
                    <md-option value="3">Низкий</md-option>
                </md-select>
            </md-input-container>
            <md-input-container flex="20">
                <md-checkbox
                        ng-model="group.active"
                        class="md-primary md-align-top-left" flex>
                    Active
                </md-checkbox>
            </md-input-container>
        </div>

        <md-input-container class="md-block">
            <label>Description</label>
            <textarea ng-model="group.description" required md-no-asterisk name="description"  md-maxlength="450" rows="5" md-select-on-focus></textarea>
            <div ng-messages="projectForm.description.$error">
                <div ng-message="required">This is required.</div>
                <div ng-message="md-maxlength">The description must be less than 30 characters long.</div>
            </div>
        </md-input-container>


            <input type="file" file-input="files">
            <li ng-repeat ="file in files "> {{file.name}}</li>

        <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
            <md-button class="md-raised" type="submit" ng-click="createGroup(group)">Submit</md-button>
        </section>

        <p style="font-size:.8em; width: 100%; text-align: center;">
            Make sure to include <a href="https://docs.angularjs.org/api/ngMessages" target="_blank">ngMessages</a> module when using ng-message markup.
        </p>
    </form>
</md-content>

    <div flex-xs flex-gt-xs="50" layout="column" ng-repeat="group in groups">
        <md-card>
            <md-card-title>
                <md-card-title-text>
                    <span class="md-headline">{{group.name}}</span>
                    <span class="md-subhead">{{group.description}}</span>
                </md-card-title-text>
                <md-card-title-media>
                    <div class="md-media-md card-media">
                        <img ng-src="/img/groups/{{group.id}}/{{group.img}}" class="md-card-image" alt="group.name">
                    </div>
                </md-card-title-media>
            </md-card-title>
            <md-card-actions layout="row" layout-align="end center">
                <md-button ng-click="deleteGroup(group.id)">Action 1</md-button>
                <md-button>Action 2</md-button>
            </md-card-actions>
        </md-card>
    </div>

<md-content layout="column" layout-gt-md="row" >

    <md-card flex flex-gt-md="30" ng-repeat="group in groups">
        <img ng-src="/img/groups/{{group.id}}/{{group.img}}" class="md-card-image" alt="group.name">
        <md-card-content>
            <h2 class="md-title">{{group.name}}</h2>
            <p>
                {{group.description}}
            </p>
        </md-card-content>
        <div class="md-actions" layout="row" layout-align="end center">
            <md-button>Action 1</md-button>
            <md-button>Action 2</md-button>
        </div>
    </md-card>
</md-content>
<div class="FlexContainer" layout layout-wrap  layout-align="center" layout-gt-md="row">
    <div class="FlexItem" flex-xs flex-gt-xs="30" ng-repeat="group in groups">

        <md-card>
            <img ng-src="/img/groups/{{group.id}}/{{group.img}}" class="md-card-image" alt="group.name">
            <md-card-content>
                <h2 class="md-title">{{group.name}}</h2>
                <p>
                    {{group.description}}
                </p>
            </md-card-content>
            <div class="md-actions" layout="row" layout-align="end center">
                <md-button>Action 1</md-button>
                <md-button>Action 2</md-button>
            </div>
        </md-card>

    </div>

</div>