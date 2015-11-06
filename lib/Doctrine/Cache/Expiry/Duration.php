<?php

/* 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Cache\Expiry;

/**
 * Time duration.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 *
 * @package Doctrine\Cache\Expiry
 */
final class Duration
{
    const ETERNAL = -1;

    const ZERO = 0;

    const SECONDS = 1;

    const MINUTES = 60;

    const HOURS = 3600;

    const DAYS = 86400;

    /**
     * @var integer The unit of time to specify time (seconds, minutes, hours, days, etc).
     */
    private $timeUnit;

    /**
     * @var float The amount in time units of duration.
     */
    private $durationAmount;

    /**
     * Constructor.
     *
     * @param integer $timeUnit
     * @param float   $durationAmount
     *
     * @throws \IllegalArgumentException If durationAmount is a negative number.
     */
    public function __construct($timeUnit, $durationAmount = 0.0)
    {
        $this->timeUnit = $timeUnit;

        if ($durationAmount < 0) {
            throw new \IllegalArgumentException('Cannot specify a negative durationAmount.');
        }

        $this->durationAmount = $durationAmount;
    }

    /**
     * Retrieve the associated TimeUnit.
     *
     * @return int
     */
    public function getTimeUnit() : int
    {
        return $this->timeUnit;
    }

    /**
     * Retrieve the number of TimeUnits in the Duration.
     *
     * @return float
     */
    public function getDurationAmount() : float
    {
        return $this->durationAmount;
    }

    /**
     * Determines if Duration is zero (always expired).
     *
     * @return bool
     */
    public function isZero() : bool
    {
        return $this->timeUnit === self::ZERO;
    }

    /**
     * Determines if Duration is eternal (forever).
     *
     * @return bool
     */
    public function isEternal() : bool
    {
        return $this->timeUnit === self::ETERNAL;
    }

    /**
     * Calculates the adjusted time given a specified time (to be adjusted) by the duration.
     *
     * @param float $time
     *
     * @return float
     */
    public function getAdjustedTime($time) : float
    {
        return $this->isEternal()
            ? 0.0 // equivalent to +INF
            : $time + ($this->durationAmount * $this->timeUnit);
    }
}
