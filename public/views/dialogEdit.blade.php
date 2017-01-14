<md-dialog aria-label="group.name" flex="70">
    <form name="groupForm" ng-cloak>
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>{{title}}</h2>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="cancel(group)">
                    <md-icon md-svg-src="img/icons/cancel.svg" aria-label="Close dialog"></md-icon>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content>
            <div class="md-dialog-content">
                <div layout="row">
                    <md-input-container flex="40">
                        <label>Название Группы</label>
                        <input required name="name" ng-model="group.name">
                        <div ng-messages="groupForm.name.$error">
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
                        <div ng-messages="groupForm.rating.$error">
                            <div ng-message="required">This is required.</div>
                        </div>
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
                    <div ng-messages="groupForm.description.$error">
                        <div ng-message="required">This is required.</div>
                        <div ng-message="md-maxlength">The description must be less than 30 characters long.</div>
                    </div>
                </md-input-container>
                <input type="file" file-input="files">
                <li ng-repeat ="file in files "> {{file.name}}</li>
            </div>
        </md-dialog-content>

        <md-dialog-actions layout="row">
            <span flex></span>
            <md-button ng-click="cancel(group)">
                Close
            </md-button>
            <md-button ng-click="edit(group)">
                Save
            </md-button>
        </md-dialog-actions>
    </form>
</md-dialog>
