<?php

abstract class AbstractDAORead {

    public abstract function request();

    public abstract function getById($id);
}
