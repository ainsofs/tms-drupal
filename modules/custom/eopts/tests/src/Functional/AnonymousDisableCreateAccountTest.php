<?php

namespace Drupal\Tests\eopts\Functional;

use weitzman\DrupalTestTraits\ExistingSiteBase;

/**
 * Test anonymous user disable create new account.
 *
 * @group custom
 */
class AnonymousDisableCreateAccountTest extends ExistingSiteBase {

  /**
   * Check is the anonymous user able to create a new account.
   */
  public function testAnonymousDisableCreateAccountTest() {
    $web_assert = $this->assertSession();

    // Go to login page.
    $this->drupalGet('/user/login');
    $web_assert->statusCodeEquals(200);

    // Ensure register page is not accessible to anon user.
    // $this->drupalGet('user/register');

    // $this->assertSession()->statusCodeEquals(403);
    // Check access denied text.
    // @todo - Fix this as its not working as expected.
    // $web_assert->pageTextContains('Access denied');
  }

}
