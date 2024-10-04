<?php

namespace App\Http\Livewire\Notification;

use App\Helpers\PortalHelpers;
use Carbon\Carbon;
use Livewire\Component;

class UserPortalNotifications extends Component
{
    public function render()
    {
        $portalNotification = PortalHelpers::getPortalNotification();

        $allNotifications = $portalNotification['Notifications'];
        $notificationsCount = $portalNotification['NotificationsCount'];

        $notifications = $allNotifications->map(function ($notify) {
            $data = json_decode($notify->data, true, 512, JSON_THROW_ON_ERROR);


              $route = '';
              
                if (PortalHelpers::getOrderType($data['Order_ID']) == 1) {
                    $route = route('Order.Details', ['Order_ID' => $data['Order_ID']]);
                } elseif (PortalHelpers::getOrderType($data['Order_ID']) == 2) {
                    $route = route('Content.Order.Details', ['Order_ID' => $data['Order_ID']]);
                } elseif (PortalHelpers::getOrderType($data['Order_ID']) == 3) {
                    $route = route('Design.Order.View', ['Order_ID' => $data['Order_ID']]);
                } elseif (PortalHelpers::getOrderType($data['Order_ID']) == 4) {
                    $route = route('Development.Order.View', ['Order_ID' => $data['Order_ID']]);
                } elseif ($data['Order_ID'] == "leave_request") {
                    $route = route('Received.Request');
                }
                
            $senderName = PortalHelpers::notificationSenderName($data['Role_Name']);

            return [
                'Emp_ID' => $data['Emp_ID'],
                'Order_ID' => $data['Order_ID'],
                'Role_Name' => $data['Role_Name'],
                'Message' => $data['Message'],
                'read_at' => $notify->read_at,
                'created_at' => Carbon::parse($notify->created_at),
                'route' => $route,
                'Sender' => $senderName,
                'id' => $notify->id
            ];
        });

        return view('livewire.notification.user-portal-notifications', compact('notifications', 'notificationsCount'))->layout('layouts.authorized');
    }
}