          <!--<div flex-xs flex-gt-xs="100" layout="row">
          <md-card>
            <md-button layout="row" layout-align="space-between center">
              <a href="https://my.freshbooks.com/service/auth/oauth/authorize?client_id=39f92eba806082694be21552b9e5b98e2718c23c739a17f11999337092295476&response_type=code&redirect_uri=https://admin-dev.trythread.com/index.php">Refresh API Data</a>
            </md-button>
          </md-card>
          </div>
            <md-card>
            <md-card-title-text>
              <span class="md-headline">Revenue by Month in \\\current_year\\\</span>
            </md-card-title-text>
            <md-card-title-media>
            <canvas id="revenue_chart"></canvas>
            </md-card-title-media>
            </md-card>
        <md-card>
        <md-card-title-text layout-align="space-between center">
          <span class="md-headline">Total Revenue in \\\current_year\\\</span><br>
          <span class="md-headline">$\\\total_revenue_by_year\\\</span>
        </md-card-title-text>
        </md-card>-->

    <md-card flex>
      <md-card-title-text id="card-title-text">
        \\\urlparms.Table.capitalize()\\\
      </md-card-title-text>

      <md-card-content>
        <md-card-action ng-repeat='ab in financial_options'>
        <md-button layout-align="start start" ng-click="change_sub_selection(ab.name)" class="md-raised md-primary">\\\ab.name\\\</md-button>
      </md-card-action>

      <div layout-align="start" class="table-responsive" ng-show="sub_selected=='Balance Sheet'">
        <h2>Assets</h2>
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Assets</th>
            <th>Current Period \\\this_period\\\</th>
            <th>Prior Period \\\previous_period\\\</th>
            <th>Increase (Decrease)</th>
          </tr>
        </thead>
          <tr>
            <td>Cash</td>
            <td>$\\\assets.current_period.cash\\\</td>
            <td>$\\\assets.previous_period.cash\\\</td>
            <td>$\\\(assets.current_period.cash - assets.previous_period.cash).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Petty Cash</td>
            <td>$\\\assets.current_period.petty_cash\\\</td>
            <td>$\\\assets.previous_period.petty_cash\\\</td>
            <td>$\\\(assets.current_period.petty_cash - assets.previous_period.petty_cash).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Accounts Receivable</td>
            <td>$\\\assets.current_period.accounts_receivable.toFixed(2)\\\</td>
            <td>$\\\assets.previous_period.accounts_receivable.toFixed(2)\\\</td>
            <td>$\\\(assets.current_period.accounts_receivable - assets.previous_period.accounts_receivable).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Inventory</td>
            <td>$\\\assets.current_period.inventory.toFixed(2)\\\</td>
            <td>$\\\assets.previous_period.inventory.toFixed(2)\\\</td>
            <td>$\\\(assets.current_period.inventory - assets.previous_period.inventory).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Prepaid Expenses</td>
            <td>$\\\assets.current_period.prepaid_expenses.toFixed(2)\\\</td>
            <td>$\\\assets.previous_period.prepaid_expenses.toFixed(2)\\\</td>
            <td>$\\\(assets.current_period.prepaid_expenses - assets.previous_period.prepaid_expenses).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Employee Advances</td>
            <td>$\\\assets.current_period.employee_advances.toFixed(2)\\\</td>
            <td>$\\\assets.previous_period.employee_advances.toFixed(2)\\\</td>
            <td>$\\\(assets.current_period.employee_advances - assets.previous_period.employee_advances).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Temporary Investments</td>
            <td>$\\\assets.current_period.temporary_investments.toFixed(2)\\\</td>
            <td>$\\\assets.previous_period.temporary_investments.toFixed(2)\\\</td>
            <td>$\\\(assets.current_period.temporary_investments - assets.previous_period.temporary_investments).toFixed(2);\\\</td>
          </tr>
          <tfoot>
            <tr>
              <td><strong>Totals</strong></td>
              <td>$\\\get_sum_current().toFixed(2)\\\</td>
              <td>$\\\get_sum_previous().toFixed(2)\\\</td>
              <td>$\\\(get_sum_current() - get_sum_previous()).toFixed(2);\\\</td>
            </tr>
          </tfoot>

         
        </table>

        <h2>Fixed Assets</h2>
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Fixed Assets</th>
            <th>Current Period \\\this_period\\\</th>
            <th>Prior Period \\\previous_period\\\</th>
            <th>Increase (Decrease)</th>
          </tr>
        </thead>
          <tr>
            <td>Land</td>
            <td>$\\\fixed_assets.current_period.land\\\</td>
            <td>$\\\fixed_assets.previous_period.land\\\</td>
            <td>$\\\(fixed_assets.current_period.land - fixed_assets.previous_period.land).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Buildings</td>
            <td>$\\\fixed_assets.current_period.buildings\\\</td>
            <td>$\\\fixed_assets.previous_period.buildings\\\</td>
            <td>$\\\(fixed_assets.current_period.buildings - fixed_assets.previous_period.buildings).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Furniture and Equipment</td>
            <td>$\\\fixed_assets.current_period.equipment.toFixed(2)\\\</td>
            <td>$\\\fixed_assets.previous_period.equipment.toFixed(2)\\\</td>
            <td>$\\\(fixed_assets.current_period.equipment - fixed_assets.previous_period.equipment).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Computer Equipment</td>
            <td>$\\\fixed_assets.current_period.computer.toFixed(2)\\\</td>
            <td>$\\\fixed_assets.previous_period.computer.toFixed(2)\\\</td>
            <td>$\\\(fixed_assets.current_period.computer - fixed_assets.previous_period.computer).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Vehicles</td>
            <td>$\\\fixed_assets.current_period.vehicles.toFixed(2)\\\</td>
            <td>$\\\fixed_assets.previous_period.vehicles.toFixed(2)\\\</td>
            <td>$\\\(fixed_assets.current_period.vehicles - fixed_assets.previous_period.vehicles).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Less: Accumulated Depreciation</td>
            <td>$\\\fixed_assets.current_period.depreciation.toFixed(2)\\\</td>
            <td>$\\\fixed_assets.previous_period.depreciation.toFixed(2)\\\</td>
            <td>$\\\(fixed_assets.current_period.deprectiation - fixed_assets.previous_period.depreciation).toFixed(2);\\\</td>
          </tr>
          <tfoot>
            <tr>
              <td><strong>Total Fixed Assets</strong></td>
              <td>$\\\get_sum_current_fixed().toFixed(2)\\\</td>
              <td>$\\\get_sum_previous_fixed().toFixed(2)\\\</td>
              <td>$\\\(get_sum_current_fixed() - get_sum_previous_fixed()).toFixed(2);\\\</td>
            </tr>
          </tfoot>
        </table>

          <h2>Other Assets</h2>
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Other Assets</th>
            <th>Current Period \\\this_period\\\</th>
            <th>Prior Period \\\previous_period\\\</th>
            <th>Increase (Decrease)</th>
          </tr>
        </thead>
          <tr>
            <td>Trademarks</td>
            <td>$\\\other_assets.current_period.trademarks\\\</td>
            <td>$\\\other_assets.previous_period.trademarks\\\</td>
            <td>$\\\(other_assets.current_period.trademarks - other_assets.previous_period.trademarks).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Patents</td>
            <td>$\\\other_assets.current_period.patents\\\</td>
            <td>$\\\other_assets.previous_period.patents\\\</td>
            <td>$\\\(other_assets.current_period.patents - other_assets.previous_period.patents).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Security Deposits</td>
            <td>$\\\other_assets.current_period.security_deposits.toFixed(2)\\\</td>
            <td>$\\\other_assets.previous_period.security_deposits.toFixed(2)\\\</td>
            <td>$\\\(other_assets.current_period.security_deposits - other_assets.previous_period.security_deposits).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Other Assets</td>
            <td>$\\\other_assets.current_period.other_assets.toFixed(2)\\\</td>
            <td>$\\\other_assets.previous_period.other_assets.toFixed(2)\\\</td>
            <td>$\\\(other_assets.current_period.other_assets - other_assets.previous_period.other_assets).toFixed(2);\\\</td>
          </tr>
          <tfoot>
            <tr>
              <td><strong>Total Other Assets</strong></td>
              <td>$\\\get_sum_current_other().toFixed(2)\\\</td>
              <td>$\\\get_sum_previous_other().toFixed(2)\\\</td>
              <td>$\\\(get_sum_current_other() - get_sum_previous_other()).toFixed(2);\\\</td>
            </tr>
          </tfoot>
        </table>


        <h2>Liabilities</h2>
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Current Liabilities</th>
            <th>Current Period \\\this_period\\\</th>
            <th>Prior Period \\\previous_period\\\</th>
            <th>Increase (Decrease)</th>
          </tr>
        </thead>
          <tr>
            <td>Accounts Payable</td>
            <td>$\\\liabilities.current_period.accounts_payable\\\</td>
            <td>$\\\liabilities.previous_period.accounts_payable\\\</td>
            <td>$\\\(liabilities.current_period.accounts_payable - liabilities.previous_period.accounts_payable).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Business Credit Cards</td>
            <td>$\\\liabilities.current_period.business_credit_cards\\\</td>
            <td>$\\\liabilities.previous_period.business_credit_cards\\\</td>
            <td>$\\\(liabilities.current_period.business_credit_cards - liabilities.previous_period.business_credit_cards).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Sales Tax Payable</td>
            <td>$\\\liabilities.current_period.sales_tax_payable.toFixed(2)\\\</td>
            <td>$\\\liabilities.previous_period.sales_tax_payable.toFixed(2)\\\</td>
            <td>$\\\(liabilities.current_period.sales_tax_payable - liabilities.previous_period.sales_tax_payable).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Payroll Liabilities</td>
            <td>$\\\liabilities.current_period.payroll_liabilities.toFixed(2)\\\</td>
            <td>$\\\liabilities.previous_period.payroll_liabilities.toFixed(2)\\\</td>
            <td>$\\\(liabilities.current_period.payroll_liabilities - liabilities.previous_period.payroll_liabilities).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Other Liabilities</td>
            <td>$\\\liabilities.current_period.other_liabilities.toFixed(2)\\\</td>
            <td>$\\\liabilities.previous_period.other_liabilities.toFixed(2)\\\</td>
            <td>$\\\(liabilities.current_period.other_liabilities - liabilities.previous_period.other_liabilities).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Current Portion of Long-Term Debt</td>
            <td>$\\\liabilities.current_period.current_portion_long_term_debt.toFixed(2)\\\</td>
            <td>$\\\liabilities.previous_period.current_portion_long_term_debt.toFixed(2)\\\</td>
            <td>$\\\(liabilities.current_period.current_portion_long_term_debt - liabilities.previous_period.current_portion_long_term_debt).toFixed(2);\\\</td>
          </tr>
          <tfoot>
            <tr>
              <td><strong>Total Current Liabilities</strong></td>
              <td>$\\\get_sum_current_liabilities_current().toFixed(2)\\\</td>
              <td>$\\\get_sum_current_liabilities_previous().toFixed(2)\\\</td>
              <td>$\\\(get_sum_current_liabilities_current() - get_sum_current_liabilities_previous()).toFixed(2);\\\</td>
            </tr>
          </tfoot>
        </table>
        
        <h2>Equity</h2>
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Current Equity</th>
            <th>Current Period \\\this_period\\\</th>
            <th>Prior Period \\\previous_period\\\</th>
            <th>Increase (Decrease)</th>
          </tr>
        </thead>
          <tr>
            <td>Capital Stock</td>
            <td>$\\\equity.current_period.capital_stock\\\</td>
            <td>$\\\equity.previous_period.capital_stock\\\</td>
            <td>$\\\(equity.current_period.capital_stock - equity.previous_period.capital_stock).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Opening Retained Earnings</td>
            <td>$\\\equity.current_period.opening_retained_earnings\\\</td>
            <td>$\\\equity.previous_period.opening_retained_earnings\\\</td>
            <td>$\\\(equity.current_period.opening_retained_earnings - equity.previous_period.opening_retained_earnings).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Dividends Paid</td>
            <td>$\\\equity.current_period.dividends_paid.toFixed(2)\\\</td>
            <td>$\\\equity.previous_period.dividends_paid.toFixed(2)\\\</td>
            <td>$\\\(equity.current_period.dividends_paid - equity.previous_period.dividends_paid).toFixed(2);\\\</td>
          </tr>
          <tr>
            <td>Net Income</td>
            <td>$\\\equity.current_period.net_income.toFixed(2)\\\</td>
            <td>$\\\equity.previous_period.net_income.toFixed(2)\\\</td>
            <td>$\\\(equity.current_period.net_income - equity.previous_period.net_income).toFixed(2);\\\</td>
          </tr>
          <tfoot>
            <tr>
              <td><strong>Total Equity</strong></td>
              <td>$\\\get_sum_equity_current().toFixed(2)\\\</td>
              <td>$\\\get_sum_equity_previous().toFixed(2)\\\</td>
              <td>$\\\(get_sum_equity_current() - get_sum_equity_previous()).toFixed(2);\\\</td>
            </tr>
          </tfoot>
        </table>

      </div>
      </md-card-content>
    </md-card>


    <md-fab-speed-dial md-open="false" md-direction="up">
          <md-fab-trigger>
            <md-button aria-label="menu" class="md-fab md-warn">
              <md-icon md-font-icon="menu">menu</md-icon>
            </md-button>
          </md-fab-trigger>
          <md-fab-actions>
          <md-button aria-label="Add Transaction" class="md-fab md-raised md-mini">
            <md-icon ng-click="add_new(urlparms.Table.capitalize())" md-font-icon="add_circle_outline" aria-label="Add New">add_circle_outline</md-icon>
          </md-button>
          <md-button aria-label="Shareable Link" class="md-fab md-raised md-mini">
            <md-icon ng-click="copy_to_clipboard()" md-font-icon="open_in_new" aria-label="Shareable Link">open_in_new</md-icon>
          </md-button>
          </md-fab-actions>
        </md-fab-speed-dial>