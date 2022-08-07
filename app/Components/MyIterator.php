<?php

namespace Iterator\Components;

class MyIterator implements \Iterator
{
    protected int $pointer;

    protected string $path;

    protected array $handler;

    public function __construct($path){
        $this->path = $path;
        $this->handler = explode(PHP_EOL, file_get_contents($path));

    }

    public function get() : array
    {
        return $this->handler;
    }

    /**
     * @throws \Exception
     */
    public function current(): array
    {
        if($this->valid()){
            return $this->handler[$this->pointer];
        }
        throw new \Exception("There is no value with this key in file" . $this->path);

    }

    public function next(): void
    {
        $this->pointer++;
    }

    public function key(): string
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return isset($this->handler[$this->pointer]);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }

    /**
     * @throws \Exception
     */
    public function readNeedle($key) : array
    {
        $this->setNeedle($key);
        if($this->valid()){
            return $this->handler[$this->pointer];
        }
        throw new \Exception("There is no value with this key in file" . $this->path);

    }
    protected function setNeedle($key) : void
    {
        $this->pointer = $key;
    }
}