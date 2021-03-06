<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2010-2014, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit_MockObject
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2010-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://github.com/sebastianbergmann/phpunit-mock-objects
 * @since      File available since Release 1.0.0
 */

/**
 * Invocation matcher which checks if a method has been invoked a certain amount
 * of times.
 * If the number of invocations exceeds the value it will immediately throw an
 * exception,
 * If the number is less it will later be checked in verify() and also throw an
 * exception.
 *
 * @package    PHPUnit_MockObject
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2010-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @version    Release: @package_version@
 * @link       http://github.com/sebastianbergmann/phpunit-mock-objects
 * @since      Class available since Release 1.0.0
 */
class PHPUnit_Framework_MockObject_Matcher_InvokedCount extends PHPUnit_Framework_MockObject_Matcher_InvokedRecorder
{
    /**
     * @var integer
     */
    protected $expectedCount;

    /**
     * @param integer $expectedCount
     */
    public function __construct($expectedCount)
    {
        $this->expectedCount = $expectedCount;
    }

    /**
     * @return boolean
     */
    public function isNever()
    {
        return $this->expectedCount == 0;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return 'invoked ' . $this->expectedCount . ' time(s)';
    }

    /**
     * @param  PHPUnit_Framework_MockObject_Invocation      $invocation
     * @throws PHPUnit_Framework_ExpectationFailedException
     */
    public function invoked(PHPUnit_Framework_MockObject_Invocation $invocation)
    {
        parent::invoked($invocation);

        $count = $this->getInvocationCount();

        if ($count > $this->expectedCount) {
            $message = $invocation->toString() . ' ';

            switch ($this->expectedCount) {
                case 0: {
                    $message .= 'was not expected to be called.';
                }
                break;

                case 1: {
                    $message .= 'was not expected to be called more than once.';
                }
                break;

                default: {
                    $message .= sprintf(
                      'was not expected to be called more than %d times.',

                      $this->expectedCount
                    );
                }
            }

            throw new PHPUnit_Framework_ExpectationFailedException($message);
        }
    }

    /**
     * Verifies that the current expectation is valid. If everything is OK the
     * code should just return, if not it must throw an exception.
     *
     * @throws PHPUnit_Framework_ExpectationFailedException
     */
    public function verify()
    {
        $count = $this->getInvocationCount();

        if ($count !== $this->expectedCount) {
            throw new PHPUnit_Framework_ExpectationFailedException(
              sprintf(
                'Method was expected to be called %d times, ' .
                'actually called %d times.',

                $this->expectedCount,
                $count
              )
            );
        }
    }
}
                   "license": [
            "MIT"
        ],
        "authors": [
            {
                "name": "PHP-FIG",
                "homepage": "http://www.php-fig.org/"
            }
        ],
        "description": "Common interface for logging libraries",
        "keywords": [
            "log",
            "psr",
            "psr-3"
        ]
    },
    {
        "name": "symfony/debug",
        "version": "v2.6.4",
        "version_normalized": "2.6.4.0",
        "target-dir": "Symfony/Component/Debug",
        "source": {
            "type": "git",
            "url": "https://github.com/symfony/Debug.git",
            "reference": "150c80059c3ccf68f96a4fceb513eb6b41f23300"
        },
        "dist": {
            "type": "zip",
            "url": "https://api.github.com/repos/symfony/Debug/zipball/150c80059c3ccf68f96a4fceb513eb6b41f23300",
            "reference": "150c80059c3ccf68f96a4fceb513eb6b41f23300",
            "shasum": ""
        },
        "require": {
            "php": ">=5.3.3",
            "psr/log": "~1.0"
        },
        "conflict": {
            "symfony/http-kernel": ">=2.3,<2.3.24|~2.4.0|>=2.5,<2.5.9|>=2.6,<2.6.2"
        },
        "require-dev": {
            "symfony/class-loader": "~2.2",
            "symfony/http-foundation": "~2.1",
            "symfony/http-kernel": "~2.3.24|~2.5.9|~2.6,>=2.6.2"
        },
        "suggest": {
            "symfony/http-foundation": "",
            "symfony/http-kernel": ""
        },
        "time": "2015-01-21 20:57:55",
        "type": "library",
        "extra": {
            "branch-alias": {
                "dev-master": "2.6-dev"
            }
        },
        "installation-source": "dist",
        "autoload": {
            "psr-0": {
                "Symfony\\Component\\Debug\\": ""
            }
        },
        "notification-url": "https://packagist.org/downloads/",
        "license": [
            "MIT"
        ],
        "authors": [
            {
                "name": "Symfony Community",
                "homepage": "http://symfony.com/contributors"
            },
            {
                "name": "Fabien Potencier",
                "email": "fabien@symfony.com"
            }
        ],
        "description": "Symfony Debug Component",
        "homepage": "http://symfony.com"
    },
    {
        "name": "symfony/http-kernel",
        "version": "v2.6.4",
        "version_normalized": "2.6.4.0",
        "target-dir": "Symfony/Component/HttpKernel",
        "source": {
            "type": "git",
            "url": "https://github.com/symfony/HttpKernel.git",
            "reference": "27abf3106d8bd08562070dd4e2438c279792c434"
        },
        "dist": {
            "type": "zip",
            "url": "https://api.github.com/repos/symfony/HttpKernel/zipball/27abf3106d8bd08562070dd4e2438c279792c434",
            "reference"