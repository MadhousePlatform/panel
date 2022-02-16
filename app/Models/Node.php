<?php

namespace App\Models;

use Database\Factories\NodeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\Node
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string $location
 * @property string $ip_address
 * @property string $domain_name
 * @property int $ssl
 * @property int $proxy
 * @property string $file_dir
 * @property int $total_memory
 * @property string $memory_overallocation_amount
 * @property int $total_disk_space
 * @property string $disk_overallocation_amount
 * @property int $daemon_port
 * @property int $daemon_sftp_port
 * @property string|null $tags
 * @property int $locked
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static NodeFactory factory(...$parameters)
 * @method static Builder|Node newModelQuery()
 * @method static Builder|Node newQuery()
 * @method static Builder|Node query()
 * @method static Builder|Node whereCreatedAt($value)
 * @method static Builder|Node whereDaemonPort($value)
 * @method static Builder|Node whereDaemonSftpPort($value)
 * @method static Builder|Node whereDeletedAt($value)
 * @method static Builder|Node whereDescription($value)
 * @method static Builder|Node whereDiskOverallocationAmount($value)
 * @method static Builder|Node whereDomainName($value)
 * @method static Builder|Node whereFileDir($value)
 * @method static Builder|Node whereId($value)
 * @method static Builder|Node whereIpAddress($value)
 * @method static Builder|Node whereLocation($value)
 * @method static Builder|Node whereLocked($value)
 * @method static Builder|Node whereMemoryOverallocationAmount($value)
 * @method static Builder|Node whereName($value)
 * @method static Builder|Node whereProxy($value)
 * @method static Builder|Node whereSlug($value)
 * @method static Builder|Node whereSsl($value)
 * @method static Builder|Node whereTags($value)
 * @method static Builder|Node whereTotalDiskSpace($value)
 * @method static Builder|Node whereTotalMemory($value)
 * @method static Builder|Node whereUpdatedAt($value)
 * @method static Builder|Node whereUserId($value)
 * @method static Builder|Node whereUuid($value)
 * @mixin Eloquent
 */
class Node extends Model
{
    use HasFactory;
    use Notifiable;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'location',
        'ip_address',
        'domain_name',
        'ssl',
        'proxy',
        'file_dir',
        'total_memory',
        'memory_overallocation_amount',
        'total_disk_space',
        'disk_overallocation_amount',
        'daemon_port',
        'daemon_sftp_port',
        'tags',
        'locked'
    ];

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param  string  $uuid
     * @return Node
     */
    public function setUuid(string $uuid): Node
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param  int  $user_id
     * @return Node
     */
    public function setUserId(int $user_id): Node
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     * @return Node
     */
    public function setName(string $name): Node
    {
        $this->name = $name;
        $this->setSlug($name);
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param  string  $slug
     * @return Node
     */
    private function setSlug(string $slug): Node
    {
        $this->slug = str()->slug($slug);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param  string|null  $description
     * @return Node
     */
    public function setDescription(?string $description): Node
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param  string  $location
     * @return Node
     */
    public function setLocation(string $location): Node
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ip_address;
    }

    /**
     * @param  string  $ip_address
     * @return Node
     */
    public function setIpAddress(string $ip_address): Node
    {
        $this->ip_address = $ip_address;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomainName(): string
    {
        return $this->domain_name;
    }

    /**
     * @param  string  $domain_name
     * @return Node
     */
    public function setDomainName(string $domain_name): Node
    {
        $this->domain_name = $domain_name;
        return $this;
    }

    /**
     * @return int
     */
    public function getSsl(): int
    {
        return $this->ssl;
    }

    /**
     * @param  int  $ssl
     * @return Node
     */
    public function setSsl(int $ssl): Node
    {
        $this->ssl = $ssl;
        return $this;
    }

    /**
     * @return int
     */
    public function getProxy(): int
    {
        return $this->proxy;
    }

    /**
     * @param  int  $proxy
     * @return Node
     */
    public function setProxy(int $proxy): Node
    {
        $this->proxy = $proxy;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileDir(): string
    {
        return $this->file_dir;
    }

    /**
     * @param  string  $file_dir
     * @return Node
     */
    public function setFileDir(string $file_dir): Node
    {
        $this->file_dir = $file_dir;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalMemory(): int
    {
        return $this->total_memory;
    }

    /**
     * @param  int  $total_memory
     * @return Node
     */
    public function setTotalMemory(int $total_memory): Node
    {
        $this->total_memory = $total_memory;
        return $this;
    }

    /**
     * @return string
     */
    public function getMemoryOverallocationAmount(): string
    {
        return $this->memory_overallocation_amount;
    }

    /**
     * @param  string  $memory_overallocation_amount
     * @return Node
     */
    public function setMemoryOverallocationAmount(string $memory_overallocation_amount): Node
    {
        $this->memory_overallocation_amount = $memory_overallocation_amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalDiskSpace(): int
    {
        return $this->total_disk_space;
    }

    /**
     * @param  int  $total_disk_space
     * @return Node
     */
    public function setTotalDiskSpace(int $total_disk_space): Node
    {
        $this->total_disk_space = $total_disk_space;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiskOverallocationAmount(): string
    {
        return $this->disk_overallocation_amount;
    }

    /**
     * @param  string  $disk_overallocation_amount
     * @return Node
     */
    public function setDiskOverallocationAmount(string $disk_overallocation_amount): Node
    {
        $this->disk_overallocation_amount = $disk_overallocation_amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getDaemonPort(): int
    {
        return $this->daemon_port;
    }

    /**
     * @param  int  $daemon_port
     * @return Node
     */
    public function setDaemonPort(int $daemon_port): Node
    {
        $this->daemon_port = $daemon_port;
        return $this;
    }

    /**
     * @return int
     */
    public function getDaemonSftpPort(): int
    {
        return $this->daemon_sftp_port;
    }

    /**
     * @param  int  $daemon_sftp_port
     * @return Node
     */
    public function setDaemonSftpPort(int $daemon_sftp_port): Node
    {
        $this->daemon_sftp_port = $daemon_sftp_port;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * @param  string|null  $tags
     * @return Node
     */
    public function setTags(?string $tags): Node
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return int
     */
    public function getLocked(): int
    {
        return $this->locked;
    }

    /**
     * @param  int  $locked
     * @return Node
     */
    public function setLocked(int $locked): Node
    {
        $this->locked = $locked;
        return $this;
    }
}
