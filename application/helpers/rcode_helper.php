<?php
class RCD{
    /*
    Code
    */
    public const SC = 200;
    public const EC_EMPTY = 201;
    public const EC_INSERT = 202;
    public const EC_UPDATE = 203;
    public const EC_DELETE = 204;
    public const EC_UNAUTH = 205;
    
    /*
    Description
    */
    public const SD = 'SUCCESS';
    public const ED_EMPTY = 'EMPTY';
    public const ED_INSERT = 'ERR INSERT';
    public const ED_UPDATE = 'ERR UPDATE';
    public const ED_DELETE = 'ERR DELETE';
    public const ED_UNAUTH = 'ERR UNAUTHORIZED';
}