<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 06.06.2015
 * Time: 14:24
 */
class ErrorCommand extends CConsoleCommand {

    const LIMIT = 30;

    public function actionIndex() {
        $queue = new QueueAccessor(
            Yii::app()->params['error_queue'],
            ErrorControllerQueue::QUEUE_NAME
        );
        printf("Starting at %s\n",date('Y-m-d H:i:s'));
        for ($i=0;$i<self::LIMIT;$i++) {
            try {
                $data = $queue->pop();
                if (!$data) {
                    throw new \Phive\Queue\Exception\NoItemException();
                }
                if (!isset($data['engine']) || !isset($data['token']) || !isset($data['result'])) {
                    throw new Exception('Wrong format of error');
                }
                switch ($data['engine']) {
                    case ErrorControllerQueue::ENGINE_GRAYLOG:
                        $parser = new GraylogErrorSaver();
                        $parser->save($data['token'], $data['result']);
                        print 'G';
                        break;
                    case ErrorControllerQueue::ENGINE_ROLLBAR:
                        $parser = new RollbarErrorSaver();
                        $parser->save($data['token'], $data['result']);
                        print 'R';
                        break;
                    default:
                        throw new Exception('Unknown engine:' . $data['engine']);
                }
            } catch (\Phive\Queue\Exception\NoItemException $e) {
                break;
            } catch (Exception $e) {
                print $e->getMessage();die();
                print '-';
            }
        }
        printf("\nFinished at %s\n",date('Y-m-d H:i:s'));
    }

}