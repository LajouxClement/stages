<?php

abstract class AbstractDAOReadWrite extends AbstractDAORead{
    //put your code here
    
    public abstract function create($obj);

    public abstract function update($obj);

    public abstract function delete($obj);

    
}
