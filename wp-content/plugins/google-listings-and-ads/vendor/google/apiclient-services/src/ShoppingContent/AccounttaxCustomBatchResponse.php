<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Automattic\WooCommerce\GoogleListingsAndAds\Vendor\Google\Service\ShoppingContent;

class AccounttaxCustomBatchResponse extends \Automattic\WooCommerce\GoogleListingsAndAds\Vendor\Google\Collection
{
  protected $collection_key = 'entries';
  /**
   * @var AccounttaxCustomBatchResponseEntry[]
   */
  public $entries;
  protected $entriesType = AccounttaxCustomBatchResponseEntry::class;
  protected $entriesDataType = 'array';
  /**
   * @var string
   */
  public $kind;

  /**
   * @param AccounttaxCustomBatchResponseEntry[]
   */
  public function setEntries($entries)
  {
    $this->entries = $entries;
  }
  /**
   * @return AccounttaxCustomBatchResponseEntry[]
   */
  public function getEntries()
  {
    return $this->entries;
  }
  /**
   * @param string
   */
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  /**
   * @return string
   */
  public function getKind()
  {
    return $this->kind;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AccounttaxCustomBatchResponse::class, 'Google_Service_ShoppingContent_AccounttaxCustomBatchResponse');
