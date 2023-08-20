<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('credit_checking_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/request-credits*") ? "c-show" : "" }} {{ request()->is("admin/request-credit-debtors*") ? "c-show" : "" }} {{ request()->is("admin/request-credit-helps*") ? "c-show" : "" }} {{ request()->is("admin/request-approvals*") ? "c-show" : "" }} {{ request()->is("admin/request-credit-attributes*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.creditChecking.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('request_credit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.request-credits.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/request-credits") || request()->is("admin/request-credits/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.requestCredit.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('request_credit_debtor_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.request-credit-debtors.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/request-credit-debtors") || request()->is("admin/request-credit-debtors/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.requestCreditDebtor.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('request_credit_help_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.request-credit-helps.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/request-credit-helps") || request()->is("admin/request-credit-helps/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.requestCreditHelp.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('request_approval_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.request-approvals.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/request-approvals") || request()->is("admin/request-approvals/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.requestApproval.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('request_credit_attribute_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.request-credit-attributes.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/request-credit-attributes") || request()->is("admin/request-credit-attributes/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.requestCreditAttribute.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('credit_checking_survey_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/survey-addresses*") ? "c-show" : "" }} {{ request()->is("admin/survey-reports*") ? "c-show" : "" }} {{ request()->is("admin/survey-report-attributes*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.creditCheckingSurvey.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('survey_address_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.survey-addresses.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/survey-addresses") || request()->is("admin/survey-addresses/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.surveyAddress.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('survey_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.survey-reports.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/survey-reports") || request()->is("admin/survey-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.surveyReport.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('survey_report_attribute_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.survey-report-attributes.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/survey-report-attributes") || request()->is("admin/survey-report-attributes/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.surveyReportAttribute.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('workflow_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/workflow-processes*") ? "c-show" : "" }} {{ request()->is("admin/workflow-request-credits*") ? "c-show" : "" }} {{ request()->is("admin/workflow-request-credit-histories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.workflow.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('workflow_process_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.workflow-processes.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/workflow-processes") || request()->is("admin/workflow-processes/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.workflowProcess.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('workflow_request_credit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.workflow-request-credits.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/workflow-request-credits") || request()->is("admin/workflow-request-credits/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.workflowRequestCredit.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('workflow_request_credit_history_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.workflow-request-credit-histories.index") }}"
                               class="c-sidebar-nav-link {{ request()->is("admin/workflow-request-credit-histories") || request()->is("admin/workflow-request-credit-histories/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.workflowRequestCreditHistory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}"
                       href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
               onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
