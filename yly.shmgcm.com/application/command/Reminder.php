<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use app\common\utils\WeChat;

class Reminder extends Command
{
    protected function configure()
    {
        $this->setName('reminder:run')
             ->setDescription('执行延时提醒任务');
    }

    protected function execute(Input $input, Output $output)
    {
        $output->writeln('开始执行延时提醒…');
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        // ……原来 controller 里的逻辑，全部搬到这里
        $output->writeln('执行完毕');
    }
}
