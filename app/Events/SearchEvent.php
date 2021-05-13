<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SearchEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'searchResults';
    }

    public function broadcastOn()
    {
        //Когда событие сработало создается объект канала
        return new Channel('search');
    }

    public function broadcastWith()
    {
        $itemsProducts = [];
        $this->products->map(function ($product, $key) use (& $itemsProducts) {
            $itemsProducts[$key]['name'] = $product->name." ".$product->art;
            $itemsProducts[$key]['url'] = $product->fullUrl;
            $itemsProducts[$key]['imgUrl'] = $product->pathImgThumbnail;
        });
        return $itemsProducts;
    }


}
