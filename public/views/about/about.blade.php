
<h1>Hello from {{title}}</h1>
<div>
    <md-content class="md-padding" layout-xs="column" layout="row">
        <div flex-xs flex-gt-xs="50" layout="column">
            <md-card >
                <md-card-title>
                    <md-card-title-text>
                        <span class="md-headline">Card with image</span>
                        <span class="md-subhead">Large</span>
                    </md-card-title-text>
                    <md-card-title-media>
                        <div class="md-media-lg card-media"></div>
                    </md-card-title-media>
                </md-card-title>
                <md-card-actions layout="row" layout-align="end center">
                    <md-button>Action 1</md-button>
                    <md-button>Action 2</md-button>
                </md-card-actions>
            </md-card>
            <md-card>
                <md-card-title>
                    <md-card-title-text>
                        <span class="md-headline">Card with image</span>
                        <span class="md-subhead">Extra Large</span>
                    </md-card-title-text>
                </md-card-title>
                <md-card-content layout="row" layout-align="space-between">
                    <div class="md-media-xl card-media"></div>
                    <md-card-actions layout="column">
                        <md-button class="md-icon-button" aria-label="Favorite"  ng-click="addToFavorite()">
                            <md-icon md-svg-icon="img/icons/{{!addedToFavorite ? 'favorite.svg' : 'heart.svg'}}"></md-icon>
                        </md-button>
                        <md-button class="md-icon-button" aria-label="Settings">
                            <md-icon md-svg-icon="img/icons/menu.svg"></md-icon>
                        </md-button>
                        <md-button class="md-icon-button" aria-label="Share">
                            <md-icon md-svg-icon="img/icons/share.svg"></md-icon>
                        </md-button>
                    </md-card-actions>
                </md-card-content>
            </md-card>
        </div>
        <div flex-xs flex-gt-xs="50" layout="column">
            <md-card>
                <md-card-title>
                    <md-card-title-text>
                        <span class="md-headline">Card with image</span>
                        <span class="md-subhead">Small</span>
                    </md-card-title-text>
                    <md-card-title-media>
                        <div class="md-media-sm card-media"></div>
                    </md-card-title-media>
                </md-card-title>
                <md-card-actions layout="row" layout-align="end center">
                    <md-button>Action 1</md-button>
                    <md-button>Action 2</md-button>
                </md-card-actions>
            </md-card>
            <md-card>
                <md-card-title>
                    <md-card-title-text>
                        <span class="md-headline">Card with image</span>
                        <span class="md-subhead">Medium</span>
                    </md-card-title-text>
                    <md-card-title-media>
                        <div class="md-media-md card-media"></div>
                    </md-card-title-media>
                </md-card-title>
                <md-card-actions layout="row" layout-align="end center">
                    <md-button>Action 1</md-button>
                    <md-button>Action 2</md-button>
                </md-card-actions>
            </md-card>
            <div layout layout-padding layout-align="center end" style="height:200px">
                <md-checkbox ng-model="showDarkTheme">Use 'Dark' Themed Cards</md-checkbox>
            </div>
        </div>
    </md-content>
</div>