<?php

declare(strict_types = 1);

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
 * USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals and is licensed under the MIT license.
 * For more information, see <http://www.doctrine-project.org>.
 */

namespace Doctrine\Cache\Expiry;

/**
 * An ExpiryPolicy based on the cache entry creation, not contemplating cache updates.
 *
 * @package Doctrine\Cache\Expiry
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class CreatedExpiryPolicy implements ExpiryPolicy
{
    /**
     * @var \Doctrine\Cache\Expiry\Duration
     */
    private $expiryDuration;

    /**
     * Constructor.
     *
     * @param \Doctrine\Cache\Expiry\Duration $expiryDuration
     */
    public function __construct(Duration $expiryDuration)
    {
        $this->expiryDuration = $expiryDuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpiryForCreation() : Duration
    {
        return $this->expiryDuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpiryForUpdate() : Duration
    {
        return new Duration(Duration::ETERNAL);
    }
}
