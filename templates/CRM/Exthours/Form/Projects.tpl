<div class="crm-form crm-form-block crm-string_override-form-block">
  <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="top"}</div>
    <table class="form-layout-compressed">
      <tr class="crm-admin-options-form-block-kimai-project-id">
        <td class="label">{$form.kimai_project_id.label}</td>
        <td>{$form.kimai_project_id.html}</td>
      </tr>
      <tr class="crm-admin-options-form-block-civicrm-organization-id">
        <td class="label">{$form.civicrm_organization_id.label}</td>
        <td>{$form.civicrm_organization_id.html}</td>
      </tr>
    </table>
  <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="bottom"}</div>
</div>

<script type="text/javascript">
  cj('form.{$form.formClass}').data('kimaiProjects', {$kimaiProjects|@json_encode});
  cj('form.{$form.formClass}').data('contactOrganization', {$contactOrganization|@json_encode});

  {literal}
    CRM.$(function($) {
      var form = $('form.{/literal}{$form.formClass}{literal}');

      $('input.crm-projects-selector', form)
        .addClass('crm-action-menu fa-code')
        .crmSelect2({
          data: form.data('kimaiProjects'),
          placeholder: '{/literal}{ts escape='js'}Select Project{/ts}{literal}'
        });

      $('input.crm-organization-selector', form)
        .addClass('crm-action-menu fa-code')
        .crmSelect2({
          data: form.data('contactOrganization'),
          placeholder: '{/literal}{ts escape='js'}Select Organization{/ts}{literal}'
        });
    });
  {/literal}
</script>
