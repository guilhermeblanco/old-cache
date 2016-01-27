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
 * Defines functions to determine when cache entries will expire based on creation, access and modification operations.
 *
 * Each of the functions return a new {@link Duration} that specifies the amount of time that must pass before a cache
 * entry is considered expired. {@link Duration} has constants defined for useful durations.
 *
 * @package Doctrine\Cache\Expiry
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface ExpiryPolicy
{
    /**
     * Gets the {@link Duration} before a newly created Cache Entry is considered expired.
     *
     * This method is called by a caching implementation after a Cache Entry is created, but before it gets added to
     * a cache, to determine the {@link Duration} before an entry expires.
     *
     * Should an exception occur while determining the Duration, an implementation specific default {@link Duration}
     * will be used.
     *
     * @return \Doctrine\Cache\Expiry\Duration
     */
    public function getExpiryForCreation() : Duration;

    /**
     * Gets the {@link Duration} before an accessed Cache Entry is considered expired.
     *
     * This method is called by a caching implementation after a Cache Entry is accessed to determine the
     * {@link Duration} before an entry expires. If a {@link Duration#ZERO} is returned a Cache Entry will be
     * considered immediately expired. Returning <code>null</code> will result in no change to the previously
     * understood expiry {@link Duration}.
     *
     * Should an exception occur while determining the Duration, an implementation specific default Duration will be
     * used.
     *
     * @return \Doctrine\Cache\Expiry\Duration
     */
    public function getExpiryForAccess() : Duration;

    /**
     * Gets the {@link Duration} before an updated Cache Entry is considered expired.
     *
     * This method is called by the caching implementation after a Cache Entry is updated to determine the
     * {@link Duration} before the updated entry expires. If a {@link Duration#ZERO} is returned a Cache Entry is
     * considered immediately expired. Returning <code>null</code> will result in no change to the previously
     * understood expiry {@link Duration}.
     *
     * Should an exception occur while determining the Duration, an implementation specific default Duration will be
     * used.
     *
     * @return \Doctrine\Cache\Expiry\Duration
     */
    public function getExpiryForUpdate() : Duration;
}
