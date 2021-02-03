{* HEADER *}
<div class="crm-block crm-form-block crm-admin-options-form-block">
  {* Display top submit button only if there are more than three elements on the page *}
  {if ($elementNames|@count) gt 3}
    <div class="crm-submit-buttons">
    {include file="CRM/common/formButtons.tpl" location="top"}
    </div>
  {/if}

  {* FIELDS (AUTOMATIC LAYOUT) *}

  {foreach from=$elementNames item=elementName}
    <div class="crm-section">
      <div class="label">{$form.$elementName.label}</div>
      <div class="content">{$form.$elementName.html}<div class="description">{$descriptions.$elementName}</div></div>
      <div class="clear"></div>
    </div>
  {/foreach}

  {* FOOTER *}
  <div class="crm-submit-buttons">
  {include class="button" file="CRM/common/formButtons.tpl" location="bottom"}
  </div>
</div>

{if $exthoursKimaiUrl}
  <div class="crm-block crm-form-block crm-admin-options-form-block">
      <div class="crm-section">
        <div class="label"><label>{ts}Status:{/ts}</label></div>
        {if $exthoursKimaiAPIKey}
          <div class="content">{ts}Configured Successfully{/ts}</div>
        {else}
          <div class="content">{ts}Need setup{/ts}</div>
        {/if}
        <div class="clear"></div>
      </div>

      <div class="action-link">
        {crmButton p="civicrm/admin/exthours/setup" q="reset=1"}{ts}Setup{/ts}{/crmButton}
      </div>
  </div>

  <div class="crm-block crm-form-block crm-admin-options-form-block">
      <div class="action-link">
        {crmButton p="civicrm/admin/exthours/project" q="reset=1"}{ts}Link Projects to Organizations{/ts}{/crmButton}
      </div>
  </div>
{/if}
