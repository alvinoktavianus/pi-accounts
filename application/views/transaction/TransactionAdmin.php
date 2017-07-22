<?php

echo $varnota;

?>

<div ng-controller="TransactionCtrl">
    <form name="transForm" novalidate="true">

        <div class="form-group">
          <ui-select ng-model="ctrl.person.selected" theme="selectize" title="Choose a person">
            <ui-select-match placeholder="Select or search a person in the list...">{{$select.selected.name}}</ui-select-match>
            <ui-select-choices repeat="item in ctrl.people | filter: $select.search">
              <div ng-bind-html="item.name | highlight: $select.search"></div>
              <small ng-bind-html="item.email | highlight: $select.search"></small>
            </ui-select-choices>
          </ui-select>
        </div>

    </form>
</div>
