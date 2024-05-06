<?php

namespace Drupal\Tests\met_tests\Functional;

use Drupal\node\NodeInterface;

/**
 *
 */
class BundleAccessTest extends MetTestBase {

  /**
   * Provides test data for testCRUD().
   */
  public function crudTestProvider() {
    return [
      ['anonymous', 'article', 'R'],
      ['anonymous', 'page', 'R'],
      ['anonymous', 'evacuation', 'R'],
      ['anonymous', 'event', 'R'],
      ['anonymous', 'event_report', ''],
      ['anonymous', 'impact_report', ''],
      ['anonymous', 'push_notification', ''],
      ['anonymous', 'request_assistance', ''],
      ['anonymous', 'met-feel-earthquake', ''],
      ['anonymous', 'met-tk', ''],
      ['anonymous', 'met-warning', ''],
      // ['authenticated', 'article', 'C'],
      // ['authenticated', 'article', 'CR'],
      // ['authenticated', 'article', 'CRU'],
      // ['administrator', 'article', 'CRUD'],
      // ['administrator', 'page', 'C'],
      // ['administrator', 'page', 'CR'],
      // ['administrator', 'page', 'CRU'],
      // ['administrator', 'page', 'CRUD'],
    ];
  }

  /**
   * Tests CRUD functionality for a particular content type.
   *
   * @param string $role
   *   The role to test.
   * @param string $bundle
   *   The content type to test.
   * @param string $permissions
   *   A string of characters indicating which operations are allowed. C =
   *   create, R = read, U = update, D = delete.
   *
   * @dataProvider crudTestProvider
   */
  public function testCRUD($role, $bundle, $permissions) {
    if ($role !== 'anonymous') {
      $account = $this->createUser([], 'test-' . $role, FALSE);
      $account->set('roles', $role);
      $account->save();
      $this->drupalLogin($account);
    }

    $this->drupalGet("node/add/$bundle");
    $expected_status = (strpos($permissions, 'C') !== FALSE) ? 200 : 403;
    $this->assertSession()->statusCodeEquals($expected_status);
    $edit = [
      'type' => $bundle,
      'status' => NodeInterface::PUBLISHED,
      'title' => 'Test ' . $bundle,
      // 'body' => 'Test body',
    ];
    $node = $this->createNode($edit);
    $this->drupalGet($node->toUrl());

    $expected_status = (strpos($permissions, 'R') !== FALSE) ? 200 : 403;
    $this->assertSession()->statusCodeEquals($expected_status);
    if (strpos($permissions, 'U') !== FALSE) {
      $edit_button = $this->getSession()->getPage()->findButton('Edit');
      if ($edit_button) {
        // Button exists, click it.
        $edit_button->press();
        $this->assertSession()->statusCodeEquals($expected_status);
      }
    }
    $this->drupalGet('node/' . $node->id() . '/delete');
    $expected_status = (strpos($permissions, 'D') !== FALSE) ? 200 : 403;
    $this->assertSession()->statusCodeEquals($expected_status);
  }

}
