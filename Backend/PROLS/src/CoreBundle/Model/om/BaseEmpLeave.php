<?php

namespace CoreBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use CoreBundle\Model\EmpAcc;
use CoreBundle\Model\EmpAccQuery;
use CoreBundle\Model\EmpLeave;
use CoreBundle\Model\EmpLeavePeer;
use CoreBundle\Model\EmpLeaveQuery;
use CoreBundle\Model\ListLeaveType;
use CoreBundle\Model\ListLeaveTypeQuery;

abstract class BaseEmpLeave extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'CoreBundle\\Model\\EmpLeavePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EmpLeavePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the request field.
     * @var        string
     */
    protected $request;

    /**
     * The value for the status field.
     * @var        string
     */
    protected $status;

    /**
     * The value for the date_started field.
     * @var        string
     */
    protected $date_started;

    /**
     * The value for the date_ended field.
     * @var        string
     */
    protected $date_ended;

    /**
     * The value for the emp_acc_id field.
     * @var        int
     */
    protected $emp_acc_id;

    /**
     * The value for the list_leave_type_id field.
     * @var        int
     */
    protected $list_leave_type_id;

    /**
     * @var        EmpAcc
     */
    protected $aEmpAcc;

    /**
     * @var        ListLeaveType
     */
    protected $aListLeaveType;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [request] column value.
     *
     * @return string
     */
    public function getRequest()
    {

        return $this->request;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {

        return $this->status;
    }

    /**
     * Get the [optionally formatted] temporal [date_started] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateStarted($format = null)
    {
        if ($this->date_started === null) {
            return null;
        }

        if ($this->date_started === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_started);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_started, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [date_ended] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateEnded($format = null)
    {
        if ($this->date_ended === null) {
            return null;
        }

        if ($this->date_ended === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_ended);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_ended, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [emp_acc_id] column value.
     *
     * @return int
     */
    public function getEmpAccId()
    {

        return $this->emp_acc_id;
    }

    /**
     * Get the [list_leave_type_id] column value.
     *
     * @return int
     */
    public function getListLeaveTypeId()
    {

        return $this->list_leave_type_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return EmpLeave The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = EmpLeavePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [request] column.
     *
     * @param  string $v new value
     * @return EmpLeave The current object (for fluent API support)
     */
    public function setRequest($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->request !== $v) {
            $this->request = $v;
            $this->modifiedColumns[] = EmpLeavePeer::REQUEST;
        }


        return $this;
    } // setRequest()

    /**
     * Set the value of [status] column.
     *
     * @param  string $v new value
     * @return EmpLeave The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = EmpLeavePeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Sets the value of [date_started] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return EmpLeave The current object (for fluent API support)
     */
    public function setDateStarted($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_started !== null || $dt !== null) {
            $currentDateAsString = ($this->date_started !== null && $tmpDt = new DateTime($this->date_started)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_started = $newDateAsString;
                $this->modifiedColumns[] = EmpLeavePeer::DATE_STARTED;
            }
        } // if either are not null


        return $this;
    } // setDateStarted()

    /**
     * Sets the value of [date_ended] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return EmpLeave The current object (for fluent API support)
     */
    public function setDateEnded($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_ended !== null || $dt !== null) {
            $currentDateAsString = ($this->date_ended !== null && $tmpDt = new DateTime($this->date_ended)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_ended = $newDateAsString;
                $this->modifiedColumns[] = EmpLeavePeer::DATE_ENDED;
            }
        } // if either are not null


        return $this;
    } // setDateEnded()

    /**
     * Set the value of [emp_acc_id] column.
     *
     * @param  int $v new value
     * @return EmpLeave The current object (for fluent API support)
     */
    public function setEmpAccId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->emp_acc_id !== $v) {
            $this->emp_acc_id = $v;
            $this->modifiedColumns[] = EmpLeavePeer::EMP_ACC_ID;
        }

        if ($this->aEmpAcc !== null && $this->aEmpAcc->getId() !== $v) {
            $this->aEmpAcc = null;
        }


        return $this;
    } // setEmpAccId()

    /**
     * Set the value of [list_leave_type_id] column.
     *
     * @param  int $v new value
     * @return EmpLeave The current object (for fluent API support)
     */
    public function setListLeaveTypeId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->list_leave_type_id !== $v) {
            $this->list_leave_type_id = $v;
            $this->modifiedColumns[] = EmpLeavePeer::LIST_LEAVE_TYPE_ID;
        }

        if ($this->aListLeaveType !== null && $this->aListLeaveType->getId() !== $v) {
            $this->aListLeaveType = null;
        }


        return $this;
    } // setListLeaveTypeId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->request = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->status = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->date_started = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->date_ended = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->emp_acc_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->list_leave_type_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 7; // 7 = EmpLeavePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating EmpLeave object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aEmpAcc !== null && $this->emp_acc_id !== $this->aEmpAcc->getId()) {
            $this->aEmpAcc = null;
        }
        if ($this->aListLeaveType !== null && $this->list_leave_type_id !== $this->aListLeaveType->getId()) {
            $this->aListLeaveType = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EmpLeavePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EmpLeavePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEmpAcc = null;
            $this->aListLeaveType = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EmpLeavePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EmpLeaveQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EmpLeavePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                EmpLeavePeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aEmpAcc !== null) {
                if ($this->aEmpAcc->isModified() || $this->aEmpAcc->isNew()) {
                    $affectedRows += $this->aEmpAcc->save($con);
                }
                $this->setEmpAcc($this->aEmpAcc);
            }

            if ($this->aListLeaveType !== null) {
                if ($this->aListLeaveType->isModified() || $this->aListLeaveType->isNew()) {
                    $affectedRows += $this->aListLeaveType->save($con);
                }
                $this->setListLeaveType($this->aListLeaveType);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = EmpLeavePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EmpLeavePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EmpLeavePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(EmpLeavePeer::REQUEST)) {
            $modifiedColumns[':p' . $index++]  = '`request`';
        }
        if ($this->isColumnModified(EmpLeavePeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(EmpLeavePeer::DATE_STARTED)) {
            $modifiedColumns[':p' . $index++]  = '`date_started`';
        }
        if ($this->isColumnModified(EmpLeavePeer::DATE_ENDED)) {
            $modifiedColumns[':p' . $index++]  = '`date_ended`';
        }
        if ($this->isColumnModified(EmpLeavePeer::EMP_ACC_ID)) {
            $modifiedColumns[':p' . $index++]  = '`emp_acc_id`';
        }
        if ($this->isColumnModified(EmpLeavePeer::LIST_LEAVE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`list_leave_type_id`';
        }

        $sql = sprintf(
            'INSERT INTO `emp_leave` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`request`':
                        $stmt->bindValue($identifier, $this->request, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case '`date_started`':
                        $stmt->bindValue($identifier, $this->date_started, PDO::PARAM_STR);
                        break;
                    case '`date_ended`':
                        $stmt->bindValue($identifier, $this->date_ended, PDO::PARAM_STR);
                        break;
                    case '`emp_acc_id`':
                        $stmt->bindValue($identifier, $this->emp_acc_id, PDO::PARAM_INT);
                        break;
                    case '`list_leave_type_id`':
                        $stmt->bindValue($identifier, $this->list_leave_type_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aEmpAcc !== null) {
                if (!$this->aEmpAcc->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEmpAcc->getValidationFailures());
                }
            }

            if ($this->aListLeaveType !== null) {
                if (!$this->aListLeaveType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aListLeaveType->getValidationFailures());
                }
            }


            if (($retval = EmpLeavePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EmpLeavePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getRequest();
                break;
            case 2:
                return $this->getStatus();
                break;
            case 3:
                return $this->getDateStarted();
                break;
            case 4:
                return $this->getDateEnded();
                break;
            case 5:
                return $this->getEmpAccId();
                break;
            case 6:
                return $this->getListLeaveTypeId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['EmpLeave'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['EmpLeave'][$this->getPrimaryKey()] = true;
        $keys = EmpLeavePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getRequest(),
            $keys[2] => $this->getStatus(),
            $keys[3] => $this->getDateStarted(),
            $keys[4] => $this->getDateEnded(),
            $keys[5] => $this->getEmpAccId(),
            $keys[6] => $this->getListLeaveTypeId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aEmpAcc) {
                $result['EmpAcc'] = $this->aEmpAcc->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aListLeaveType) {
                $result['ListLeaveType'] = $this->aListLeaveType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EmpLeavePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setRequest($value);
                break;
            case 2:
                $this->setStatus($value);
                break;
            case 3:
                $this->setDateStarted($value);
                break;
            case 4:
                $this->setDateEnded($value);
                break;
            case 5:
                $this->setEmpAccId($value);
                break;
            case 6:
                $this->setListLeaveTypeId($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = EmpLeavePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setRequest($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setStatus($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDateStarted($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setDateEnded($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setEmpAccId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setListLeaveTypeId($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EmpLeavePeer::DATABASE_NAME);

        if ($this->isColumnModified(EmpLeavePeer::ID)) $criteria->add(EmpLeavePeer::ID, $this->id);
        if ($this->isColumnModified(EmpLeavePeer::REQUEST)) $criteria->add(EmpLeavePeer::REQUEST, $this->request);
        if ($this->isColumnModified(EmpLeavePeer::STATUS)) $criteria->add(EmpLeavePeer::STATUS, $this->status);
        if ($this->isColumnModified(EmpLeavePeer::DATE_STARTED)) $criteria->add(EmpLeavePeer::DATE_STARTED, $this->date_started);
        if ($this->isColumnModified(EmpLeavePeer::DATE_ENDED)) $criteria->add(EmpLeavePeer::DATE_ENDED, $this->date_ended);
        if ($this->isColumnModified(EmpLeavePeer::EMP_ACC_ID)) $criteria->add(EmpLeavePeer::EMP_ACC_ID, $this->emp_acc_id);
        if ($this->isColumnModified(EmpLeavePeer::LIST_LEAVE_TYPE_ID)) $criteria->add(EmpLeavePeer::LIST_LEAVE_TYPE_ID, $this->list_leave_type_id);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(EmpLeavePeer::DATABASE_NAME);
        $criteria->add(EmpLeavePeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of EmpLeave (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setRequest($this->getRequest());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setDateStarted($this->getDateStarted());
        $copyObj->setDateEnded($this->getDateEnded());
        $copyObj->setEmpAccId($this->getEmpAccId());
        $copyObj->setListLeaveTypeId($this->getListLeaveTypeId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return EmpLeave Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return EmpLeavePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EmpLeavePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a EmpAcc object.
     *
     * @param                  EmpAcc $v
     * @return EmpLeave The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEmpAcc(EmpAcc $v = null)
    {
        if ($v === null) {
            $this->setEmpAccId(NULL);
        } else {
            $this->setEmpAccId($v->getId());
        }

        $this->aEmpAcc = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the EmpAcc object, it will not be re-added.
        if ($v !== null) {
            $v->addEmpLeave($this);
        }


        return $this;
    }


    /**
     * Get the associated EmpAcc object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return EmpAcc The associated EmpAcc object.
     * @throws PropelException
     */
    public function getEmpAcc(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aEmpAcc === null && ($this->emp_acc_id !== null) && $doQuery) {
            $this->aEmpAcc = EmpAccQuery::create()->findPk($this->emp_acc_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmpAcc->addEmpLeaves($this);
             */
        }

        return $this->aEmpAcc;
    }

    /**
     * Declares an association between this object and a ListLeaveType object.
     *
     * @param                  ListLeaveType $v
     * @return EmpLeave The current object (for fluent API support)
     * @throws PropelException
     */
    public function setListLeaveType(ListLeaveType $v = null)
    {
        if ($v === null) {
            $this->setListLeaveTypeId(NULL);
        } else {
            $this->setListLeaveTypeId($v->getId());
        }

        $this->aListLeaveType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ListLeaveType object, it will not be re-added.
        if ($v !== null) {
            $v->addEmpLeave($this);
        }


        return $this;
    }


    /**
     * Get the associated ListLeaveType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return ListLeaveType The associated ListLeaveType object.
     * @throws PropelException
     */
    public function getListLeaveType(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aListLeaveType === null && ($this->list_leave_type_id !== null) && $doQuery) {
            $this->aListLeaveType = ListLeaveTypeQuery::create()->findPk($this->list_leave_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aListLeaveType->addEmpLeaves($this);
             */
        }

        return $this->aListLeaveType;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->request = null;
        $this->status = null;
        $this->date_started = null;
        $this->date_ended = null;
        $this->emp_acc_id = null;
        $this->list_leave_type_id = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->aEmpAcc instanceof Persistent) {
              $this->aEmpAcc->clearAllReferences($deep);
            }
            if ($this->aListLeaveType instanceof Persistent) {
              $this->aListLeaveType->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aEmpAcc = null;
        $this->aListLeaveType = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EmpLeavePeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
