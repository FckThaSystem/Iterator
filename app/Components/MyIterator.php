<?php

namespace Iterator\Components;

class MyIterator implements \Iterator
{
    protected int $pointer;

    protected string $path;

    protected mixed $handler;

    public function __construct($path){
        $this->path = $path;
        $this->handler = explode(PHP_EOL, file_get_contents($path));

    }

    public function get()
    {
        return $this->handler;
    }

    public function current(): mixed
    {
        return $this->handler[$this->pointer];
    }

    public function next(): void
    {
        $this->pointer++;
    }

    public function key(): mixed
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

    public function readNeedle($key) : mixed
    {
        $this->setNeedle($key);
        if($this->valid()){
            return $this->handler[$this->pointer];
        }
        $error = new \Error("There is no value with this key in file" . $this->path);
        return $error->getMessage();
    }
    protected function setNeedle($key) : void
    {
        $this->pointer = $key;
    }
}