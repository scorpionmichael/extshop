<?php
namespace Scorpshop\Scorpshop\Task;

class LocationTaskAdditionalFieldProvider implements \TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface {
    public function getAdditionalFields(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) 
    {
		if (!isset($taskInfo['pid']))
		{
			$taskInfo['pid'] = 'default value';
			if ($parentObject->CMD === 'edit') 
			{
				$taskInfo['pid'] = $task->pid;
			}
		}

		$fieldName = 'tx_scheduler[pid]';
		$fieldId = 'pid';
		$fieldValue = $taskInfo['pid'];
		$fieldHtml = '<input type="text" name="' . $fieldName . '" id="' . $fieldId . '" value="' . htmlspecialchars($fieldValue) . '" />';

		$additionalFields[$fieldId] = array(
			'code' => $fieldHtml,
			'label' => 'Pid',
			'cshKey' => '_MOD_tools_txschedulerM1',
			'cshLabel' => $fieldId
		);

		return $additionalFields;
    }

    public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) 
    {
		$string = $submittedData['pid'];

		if (trim($string) == '')
		{
			$parentObject->addMessage($GLOBALS['LANG']->sL('Value must not be empty'), \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
			return FALSE;		
		}

        return true;               
    }

    public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task) 
    {
        $task->pid = $submittedData['pid'];
    }
}