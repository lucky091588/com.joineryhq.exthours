{if $action eq 1 or $action eq 2}
  {include file="CRM/Exthours/Form/Projects.tpl"}
{elseif $action eq 8}

{else}
  <div class="crm-content-block crm-block">
    {if $rows}
      <div class="crm-content-block crm-block">
         {strip}
          {* handle enable/disable actions*}
          {include file="CRM/common/enableDisableApi.tpl"}
          <table id="options" class="row-highlight">
              <thead>
                <tr>
                  <th>{ts}ID{/ts}</th>
                  <th>{ts}Kimai Project Name{/ts}</th>
                  <th>{ts}CiviCRM Organization Name{/ts}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
            {foreach from=$rows item=row}
              <tr id="TokenDefaultSet-{$row.id}" data-action="setvalue" class="crm-entity {cycle values="odd-row,even-row"}">
                <td>{$row.id}</td>
                <td>{$row.name}</td>
                <td>{$row.orgName}</td>
                <td>{$row.action|replace:'xx':$row.id}</td>
              </tr>
            {/foreach}
            </tbody>
          </table>
          {/strip}
        </div>
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
    </div>
  </div>
{/if}
