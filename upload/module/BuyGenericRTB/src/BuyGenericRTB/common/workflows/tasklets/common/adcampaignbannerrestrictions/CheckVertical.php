<?php
/**
 * CDNPAL NGINAD Project
 *
 * @link http://www.nginad.com
 * @copyright Copyright (c) 2013-2015 CDNPAL Ltd. All Rights Reserved
 * @license GPLv3
 */

namespace buyrtb\workflows\tasklets\common\adcampaignbannerrestrictions;

class CheckVertical {

	public static function execute(&$Logger, &$Workflow, \model\openrtb\RtbBidRequest &$RtbBidRequest, \model\openrtb\RtbBidRequestImp &$RtbBidRequestImp, &$AdCampaignBanner, &$AdCampaignBannerRestrictions) {

		/*
		 * Check banner for it being in the right vertical
		 */
		if ($AdCampaignBannerRestrictions->Vertical !== null && $RtbBidRequest->RtbBidRequestSite->RtbBidRequestPublisher->cat !== null):
		
			$has_vertical = false;
			
			$vertical_list = explode(",", $AdCampaignBannerRestrictions->Vertical);
			foreach ($vertical_list as $vertical_id):
				
				if ($RtbBidRequest->RtbBidRequestSite->RtbBidRequestPublisher->cat == $vertical_id):
				
					$has_vertical = true;
					break;
					
				endif;
				
			endforeach;
			
			if ($has_vertical === false):
				if ($Logger->setting_log === true):
					$Logger->log[] = "Failed: " . "Check banner for it being in the right vertical :: EXPECTED: " . $AdCampaignBannerRestrictions->Vertical . " GOT: " . $RtbBidRequest->RtbBidRequestSite->RtbBidRequestPublisher->cat;
				endif;
				return false;
			endif;
			
		endif;
		
		return true;
		
	}

}