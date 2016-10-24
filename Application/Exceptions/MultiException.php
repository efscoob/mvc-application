<?php

namespace Application\Exceptions;


class MultiException
    extends \Exception
    implements \ArrayAccess, \Iterator
{
    use TArrayAccesss, TIterator;
    
}