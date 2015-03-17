
<div data-ng-controller="testerController as tester">
    <div class="row">
        <form data-ng-submit="tester.testMatch()">
            <div class="form-group col-md-12 col-sm-12 col-lg-12 col-xs-12">
                <label for="match_value">Test Expression</label>

                <div class="input-group">
                    <input type="text" id="match_value" class="form-control"
                           placeholder="Your test string..."
                           data-ng-model="tester.matchValue">
            <span class="input-group-btn">
                <input type="submit" id="btn-test-expression" class="btn btn-primary" value="Test" data-ng-disabled="creator.regex.length==0">
            </span>
                </div>
            </div>
        </form>
    </div>

    <div class="row tester-message" data-ng-if="tester.matchMessage">
        <div class="col-md-12 col-sm12 col-lg-12 col-xs-12">
            <div class="alert"
                 data-ng-class="{
                            'alert-warning': tester.matchMessage.type=='warning',
                            'alert-info': tester.matchMessage.type=='info',
                            'alert-success': tester.matchMessage.type=='success',
                            'alert-danger': tester.matchMessage.type=='danger'
                        }">

                <% tester.matchMessage.message %>
            </div>
        </div>
    </div>

</div>