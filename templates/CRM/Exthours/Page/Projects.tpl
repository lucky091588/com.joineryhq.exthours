{if $action eq 1 or $action eq 2}
  {include file="CRM/Exthours/Form/Projects.tpl"}
{elseif $action eq 8}

{else}
  <div class="crm-content-block crm-block">
    {if $rows}

    {else}
       {if $action ne 1} {* When we are adding an item, we should not display this message *}
         <div class="messages status no-popup">
           <img src="{$config->resourceBase}i/Inform.gif" alt="{ts}status{/ts}"/> &nbsp;
           {ts}No projects has been integrated yet. Just click 'Add Project' button to add one.{/ts}
         </div>
       {/if}
    {/if}
    <div class="action-link">
      {crmButton p='civicrm/admin/exthours/projects' q="action=add&reset=1" id="newProjects"  icon="plus-circle"}{ts}Add Project{/ts}{/crmButton}
      {crmButton p="civicrm/admin/exthours/projects" q="reset=1" class="cancel" icon="times"}{ts}Done{/ts}{/crmButton}
    </div>
  </div>
{/if}
