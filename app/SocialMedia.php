<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    /**
     *
     * @var array $fillable
     */
    protected $fillable = ['personal_account_url','social_share_url', 'social_name','social_icon', 'sharable'];

    /**
     * Get Social Media Networks with sharable set to true
     *
     */
    public function scopeGetSharableNetworks($query)
    {
        return $query->where('sharable', true)->get();
    }

    /**
     * Generate a network url based on the given page url
     *
     * @param array $network
     * @param array $data
     * @return string
     */
    public static function generateNetworkUrls($network, $data)
    {
        if ($network['social_name'] === 'twitter') {
            return $network['social_share_url'] . $data['url'] . '&text=' . $data['title'] . '&via=TasosTogridis'; 
        }

        if ($network['social_name'] === 'facebook') {
            return $network['social_share_url'] . $data['url'];
        }
    }
}
