<?php

class Events extends Controller
{
    public function __construct()
    {

    }
    public static function index($calendar_service)
    {
        if (!isset($_GET['id'])) {
            header('Location: home');
        }
        $data = [];
        $data['events_list'] = $calendar_service->get_events($_GET['id'])['items'];
        return parent::view('events/index', $data);
    }

    public static function create($calendar_service)
    {
        if (isset($_POST['data'])) {
            if ($_POST['data']['operation'] === 'update') {
                if (!isset($_SESSION['user_timezone'])) {
                    $_SESSION['user_timezone'] = $calendar_service->get_user_timezone();
                }

                $data = (array) $_POST['data'];
                $data['time_zone'] = $_SESSION['user_timezone'];
                $new_event = $calendar_service->update_event($data);
                echo json_encode(['event_id' => $new_event['id']]);
                exit;
            }
            if ($_POST['data']['operation'] === 'create') {
                if (!isset($_SESSION['user_timezone'])) {
                    $_SESSION['user_timezone'] = $calendar_service->get_user_timezone();
                }

                $data = (array) $_POST['data'];
                $data['time_zone'] = $_SESSION['user_timezone'];
                $new_event = $calendar_service->create_event($data);
                echo json_encode(['event_id' => $new_event['id']]);
                exit;
            }
        }

        return parent::view('events/create');
    }

    public static function delete($calendar_service)
    {
        if (isset($_POST['data'])) {
            $data = (array) $_POST['data'];
            $delete_event = $calendar_service->delete_event($data);
            echo json_encode(['deleted' => 1]);
            exit;
        }
    }
}
