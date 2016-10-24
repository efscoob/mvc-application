<?php

namespace Application;

/**
 * Class Logger
 * @package Application
 */
class Logger
    implements ILogger
{
    /**
     * Полный путь к log-файлу
     */
    const _DS = DIRECTORY_SEPARATOR;
    const PATH = __DIR__ . self::_DS . 'logs';

    /**
     * @var array $options Массив настроек
     */
    protected $options = [
        'extention' => 'txt',
        'dateformat' => 'Y-m-d G:i:s.u',
        'prefix' => 'log_'
    ];

    /**
     * @var bool $loggerOn Флаг записи в log-файл
     */
    protected static $loggerOn = true;

    /**
     * @var string $file абсолютное имя log-файла
     */
    protected $file;

    /**
     * @var int/bool $fileHandle Количество байт записанных в файл
     */
    protected $fileHandle;

    /**
     * Конструктор класса Logger
     *
     * @param string $name Содержит имя файла
     * @param array $array Переданные пользователем опции
     */
    function __construct(string $name, array $array = [])
    {
        $this->file = self::PATH . static::_DS . $this->options['prefix'] . $name . '.' . $this->options['extention'];
        if ($array) {
            $this->options = array_merge($this->options, $array);
        }
    }

    /**
     * Отвечает за обработку, форматировние и запись сообщения об ошибке в лог-файл
     *
     * @param string $msg Сообщение об ошибке
     * @param $file Имя файла, в котором возникла ошибка
     * @param $line Строка, на которой возникла ошибка
     * @throws Exceptions\Core
     */
    public function error(string $msg, $file, $line)
    {
        if ($this->getLoggerOn()) {
            $message = "[ERROR] [{$this->getTimestamp()}] [Файл - $file, строка - $line] $msg" . PHP_EOL;
            $this->writeToLogFile($message);
        }
    }

    /**
     * Отвечает за обработку, форматировние и запись информационного сообщения в лог-файл
     *
     * @param string $msg
     * @throws Exceptions\Core
     */
    public function info(string $msg)
    {
        if ($this->getLoggerOn()) {
            $message = "[INFO] [{$this->getTimestamp()}] $msg" . PHP_EOL;
            $this->writeToLogFile($message);            
        }
    }

    /**
     * Запись подготовленной строки сообщения в log-файл
     *
     * @param string $logmsg Отформатированное сообщение для записи в log-файл
     * @throws \Application\Exceptions\Core Отслеживаем ошибку записи в log-файл
     */
    protected function writeToLogFile(string $logmsg)
    {
        if (false === file_put_contents($this->file, $logmsg, FILE_APPEND)) {
            throw new \Application\Exceptions\Core('Ошибка записи сообщения в log-файл. Провьте права доступа');
        }
    }

    /**
     * Метод возвращает текущую дату в заданном формате
     * 
     * @return string
     */
    protected function getTimestamp()
    {
        $date = new \DateTime();
        return $date->format($this->options['dateformat']);
    }

    /**
     * Устанавливает формат даты
     *
     * @param string $dateFormat Валидный формат даты и времени для date()
     */
    public function setDateFormat($dateFormat)
    {
        $this->options['dateFormat'] = $dateFormat;
    }

    /**
     * Метод возвращает текущее значение флага $loggerOn
     *
     * @return bool
     */
    public function getLoggerOn() 
    {
        return static::$loggerOn;
    }

    /**
     * Устанавливаем флаг доступа возможности записи в log-файл
     *
     * @param boolean $loggerOn Значение флага
     */
    public function setLoggerOn(bool $loggerOn = true)
    {
        static::$loggerOn = $loggerOn;
    }
}