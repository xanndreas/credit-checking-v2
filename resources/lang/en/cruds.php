<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'profile'                  => 'Profile',
            'profile_helper'           => ' ',
        ],
    ],
    'creditChecking' => [
        'title'          => 'Credit Checking',
        'title_singular' => 'Credit Checking',
    ],
    'requestCredit' => [
        'title'          => 'Request Credit',
        'title_singular' => 'Request Credit',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'batch_number'             => 'Batch Number',
            'batch_number_helper'      => ' ',
            'credit_type'              => 'Credit Type',
            'credit_type_helper'       => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'auto_planner'             => 'Auto Planner',
            'auto_planner_helper'      => ' ',
            'request_debtor'           => 'Request Debtor',
            'request_debtor_helper'    => ' ',
            'request_attribute'        => 'Request Attribute',
            'request_attribute_helper' => ' ',
            'dealer_name'              => 'Dealer Name',
            'dealer_name_helper'       => ' ',
            'sales_name'               => 'Sales Name',
            'sales_name_name_helper'   => ' ',
            'product_name'             => 'Product Name',
            'product_name_name_helper' => ' ',
            'brand_name'               => 'Brand Name',
            'brand_name_name_helper'   => ' ',
            'models'                   => 'Model Name',
            'models_name_helper'       => ' ',
            'workflow_process'         => 'Workflow Process',
            'workflow_process_helper'  => ' ',
            'dealer'                    => 'Dealer',
            'dealer_helper'             => ' ',
            'product_text'                   => 'Product',
            'product_text_helper'            => ' ',
            'dealer_text'               => 'Other Dealer',
            'dealer_text_helper'        => ' ',
            'brand_text'                => 'Other Brands',
            'brand_text_helper'         => ' ',
            'car_year'                => 'Car Year',
            'car_year_helper'         => ' ',
            'down_payment_text'         => 'Other DPs',
            'down_payment_text_helper'  => ' ',
            'brand'                     => 'Brand',
            'brand_helper'              => ' ',
            'number_of_units'           => 'Number Of Units',
            'number_of_units_helper'    => ' ',
            'otr'                       => 'OTR',
            'otr_helper'                => ' ',
            'debt_principal'            => 'Debt Principal',
            'debt_principal_helper'     => ' ',
            'insurance_text'            => 'Insurance',
            'insurance_text_helper'     => ' ',
            'down_payment'              => 'Down Payment',
            'down_payment_helper'       => ' ',
            'tenors_text'               => 'Tenors',
            'tenors_text_helper'        => ' ',
            'addm_addb'                 => 'ADDM / ADDB',
            'addm_addb_helper'          => ' ',
            'effective_rates'           => 'Effective Rates',
            'effective_rates_helper'    => ' ',
            'debtor_phone'              => 'Debtor Phone',
            'debtor_phone_helper'       => ' ',
            'id_photos'                 => 'ID Photos',
            'id_photos_helper'          => ' ',
            'kk_photos'                 => 'KK Photos',
            'kk_photos_helper'          => ' ',
            'npwp_photos'               => 'NPWP Photos',
            'npwp_photos_helper'        => ' ',
            'other_photos'              => 'Other Photos',
            'other_photos_helper'       => ' ',
            'remarks'                   => 'Remarks',
            'remarks_helper'            => ' ',
            'debtor_information'        => 'Debtor Information',
            'debtor_information_helper' => ' ',
        ],
    ],
    'requestCreditDebtor' => [
        'title'          => 'Request Credit Debtor',
        'title_singular' => 'Request Credit Debtor',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'personel_type'          => 'Personel Type',
            'personel_type_helper'   => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'identity_type'          => 'Identity Type',
            'identity_type_helper'   => ' ',
            'identity_number'        => 'Identity Number',
            'identity_number_helper' => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'requestCreditHelp' => [
        'title'          => 'Request Credit Help',
        'title_singular' => 'Request Credit Help',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'type'               => 'Type',
            'type_helper'        => ' ',
            'attribute'          => 'Attribute',
            'attribute_helper'   => ' ',
            'attribute_2'        => 'Attribute 2',
            'attribute_2_helper' => ' ',
            'attribute_3'        => 'Attribute 3',
            'attribute_3_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'workflow' => [
        'title'          => 'Workflow',
        'title_singular' => 'Workflow',
    ],
    'workflowProcess' => [
        'title'          => 'Workflow Process',
        'title_singular' => 'Workflow Process',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'process_status'        => 'Process Status',
            'process_status_helper' => ' ',
            'description'           => 'Description',
            'description_helper'    => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'workflowRequestCredit' => [
        'title'          => 'Workflow Request Credit',
        'title_singular' => 'Workflow Request Credit',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'request_credit_batch'        => 'Request Credit Batch',
            'request_credit_batch_helper' => ' ',
            'request_credit'              => 'Request Credit',
            'request_credit_helper'       => ' ',
            'last_change_by'              => 'Last Change By',
            'last_change_by_helper'       => ' ',
            'process_status'              => 'Process Status',
            'process_status_helper'       => ' ',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
        ],
    ],
    'workflowRequestCreditHistory' => [
        'title'          => 'Workflow Request Credit History',
        'title_singular' => 'Workflow Request Credit History',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => ' ',
            'workflow_request_credit'        => 'Workflow',
            'workflow_request_credit_helper' => ' ',
            'actor'                          => 'Actor',
            'actor_helper'                   => ' ',
            'process_status'                 => 'Process Status',
            'process_status_helper'          => ' ',
            'process_notes'                  => 'Process Notes',
            'process_notes_helper'           => ' ',
            'created_at'                     => 'Created at',
            'created_at_helper'              => ' ',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => ' ',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => ' ',
            'attribute'                      => 'Attribute',
            'attribute_helper'               => ' ',
            'attribute_2'                    => 'Attribute 2',
            'attribute_2_helper'             => ' ',
        ],
    ],
    'creditCheckingSurvey' => [
        'title'          => 'Credit Checking Survey',
        'title_singular' => 'Credit Checking Survey',
    ],
    'requestApproval' => [
        'title'          => 'Request Approval',
        'title_singular' => 'Request Approval',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'surveyAddress' => [
        'title'          => 'Survey Addresses',
        'title_singular' => 'Survey Address',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'request_credit'        => 'Request Credit',
            'request_credit_helper' => ' ',
            'address_type'          => 'Address Type',
            'address_type_helper'   => ' ',
            'addresses'             => 'Addresses',
            'addresses_helper'      => ' ',
            'surveyor'              => 'Surveyor',
            'surveyor_helper'       => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'surveyReport' => [
        'title'          => 'Survey Report',
        'title_singular' => 'Survey Report',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'survey_address'           => 'Survey Address',
            'survey_address_helper'    => ' ',
            'submited_by'              => 'Submited By',
            'submited_by_helper'       => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'survey_attributes'        => 'Survey Attributes',
            'survey_attributes_helper' => ' ',
            'request_credit'           => 'Request Credit',
            'request_credit_helper'    => ' ',
        ],
    ],
    'surveyReportAttribute' => [
        'title'          => 'Survey Report Attribute',
        'title_singular' => 'Survey Report Attribute',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'object_name'        => 'Object Name',
            'object_name_helper' => ' ',
            'attribute'          => 'Attribute',
            'attribute_helper'   => ' ',
            'attribute_2'        => 'Attribute 2',
            'attribute_2_helper' => ' ',
            'attribute_3'        => 'Attribute 3',
            'attribute_3_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'requestCreditAttribute' => [
        'title'          => 'Request Credit Attribute',
        'title_singular' => 'Request Credit Attribute',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'object_name'        => 'Object Name',
            'object_name_helper' => ' ',
            'attribute'          => 'Attribute',
            'attribute_helper'   => ' ',
            'attribute_2'        => 'Attribute 2',
            'attribute_2_helper' => ' ',
            'attribute_3'        => 'Attribute 3',
            'attribute_3_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],

];
