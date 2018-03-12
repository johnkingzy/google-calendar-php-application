<?php

class Dashboard extends Controller
{
    public static function index($calendar_service)
    {
        $data = [];
        $data['calendar_lists'] = $calendar_service->get_calendars()['items'];
        return parent::view('dashboard/index', $data);
    }

    public static function create($calendar_service)
    {
        if (!isset($_SESSION['user_timezone'])) {
            $_SESSION['user_timezone'] = $calendar_service->get_user_timezone();
        }
        $result = $calendar_service->create_calendar($_POST['data']);
        echo json_encode(['calendar_id' => $result['id']]);
    }

    public static function delete($calendar_service)
    {
        $data = $_POST['data'];
        $result = $calendar_service->delete_calendar($data);
        echo json_encode(['deleted' => 1]);
    }
}
