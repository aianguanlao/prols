<?php

namespace CoreBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use CoreBundle\Model\EmpAcc;
use CoreBundle\Model\EmpContact;
use CoreBundle\Model\EmpProfile;
use CoreBundle\Model\EmpProfilePeer;
use CoreBundle\Model\EmpProfileQuery;

/**
 * @method EmpProfileQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EmpProfileQuery orderByEmpAccAccId($order = Criteria::ASC) Order by the emp_acc_acc_id column
 * @method EmpProfileQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method EmpProfileQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method EmpProfileQuery orderByMname($order = Criteria::ASC) Order by the mname column
 * @method EmpProfileQuery orderByBday($order = Criteria::ASC) Order by the bday column
 * @method EmpProfileQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method EmpProfileQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method EmpProfileQuery orderByImgPath($order = Criteria::ASC) Order by the img_path column
 * @method EmpProfileQuery orderByDateJoined($order = Criteria::ASC) Order by the date_joined column
 *
 * @method EmpProfileQuery groupById() Group by the id column
 * @method EmpProfileQuery groupByEmpAccAccId() Group by the emp_acc_acc_id column
 * @method EmpProfileQuery groupByFname() Group by the fname column
 * @method EmpProfileQuery groupByLname() Group by the lname column
 * @method EmpProfileQuery groupByMname() Group by the mname column
 * @method EmpProfileQuery groupByBday() Group by the bday column
 * @method EmpProfileQuery groupByAddress() Group by the address column
 * @method EmpProfileQuery groupByGender() Group by the gender column
 * @method EmpProfileQuery groupByImgPath() Group by the img_path column
 * @method EmpProfileQuery groupByDateJoined() Group by the date_joined column
 *
 * @method EmpProfileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EmpProfileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EmpProfileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EmpProfileQuery leftJoinEmpAcc($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmpAcc relation
 * @method EmpProfileQuery rightJoinEmpAcc($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmpAcc relation
 * @method EmpProfileQuery innerJoinEmpAcc($relationAlias = null) Adds a INNER JOIN clause to the query using the EmpAcc relation
 *
 * @method EmpProfileQuery leftJoinEmpContact($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmpContact relation
 * @method EmpProfileQuery rightJoinEmpContact($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmpContact relation
 * @method EmpProfileQuery innerJoinEmpContact($relationAlias = null) Adds a INNER JOIN clause to the query using the EmpContact relation
 *
 * @method EmpProfile findOne(PropelPDO $con = null) Return the first EmpProfile matching the query
 * @method EmpProfile findOneOrCreate(PropelPDO $con = null) Return the first EmpProfile matching the query, or a new EmpProfile object populated from the query conditions when no match is found
 *
 * @method EmpProfile findOneByEmpAccAccId(int $emp_acc_acc_id) Return the first EmpProfile filtered by the emp_acc_acc_id column
 * @method EmpProfile findOneByFname(string $fname) Return the first EmpProfile filtered by the fname column
 * @method EmpProfile findOneByLname(string $lname) Return the first EmpProfile filtered by the lname column
 * @method EmpProfile findOneByMname(string $mname) Return the first EmpProfile filtered by the mname column
 * @method EmpProfile findOneByBday(string $bday) Return the first EmpProfile filtered by the bday column
 * @method EmpProfile findOneByAddress(string $address) Return the first EmpProfile filtered by the address column
 * @method EmpProfile findOneByGender(string $gender) Return the first EmpProfile filtered by the gender column
 * @method EmpProfile findOneByImgPath(string $img_path) Return the first EmpProfile filtered by the img_path column
 * @method EmpProfile findOneByDateJoined(string $date_joined) Return the first EmpProfile filtered by the date_joined column
 *
 * @method array findById(int $id) Return EmpProfile objects filtered by the id column
 * @method array findByEmpAccAccId(int $emp_acc_acc_id) Return EmpProfile objects filtered by the emp_acc_acc_id column
 * @method array findByFname(string $fname) Return EmpProfile objects filtered by the fname column
 * @method array findByLname(string $lname) Return EmpProfile objects filtered by the lname column
 * @method array findByMname(string $mname) Return EmpProfile objects filtered by the mname column
 * @method array findByBday(string $bday) Return EmpProfile objects filtered by the bday column
 * @method array findByAddress(string $address) Return EmpProfile objects filtered by the address column
 * @method array findByGender(string $gender) Return EmpProfile objects filtered by the gender column
 * @method array findByImgPath(string $img_path) Return EmpProfile objects filtered by the img_path column
 * @method array findByDateJoined(string $date_joined) Return EmpProfile objects filtered by the date_joined column
 */
abstract class BaseEmpProfileQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEmpProfileQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'CoreBundle\\Model\\EmpProfile';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EmpProfileQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   EmpProfileQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EmpProfileQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EmpProfileQuery) {
            return $criteria;
        }
        $query = new EmpProfileQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   EmpProfile|EmpProfile[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EmpProfilePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EmpProfilePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 EmpProfile A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 EmpProfile A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `emp_acc_acc_id`, `fname`, `lname`, `mname`, `bday`, `address`, `gender`, `img_path`, `date_joined` FROM `emp_profile` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new EmpProfile();
            $obj->hydrate($row);
            EmpProfilePeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return EmpProfile|EmpProfile[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|EmpProfile[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmpProfilePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmpProfilePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EmpProfilePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EmpProfilePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the emp_acc_acc_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpAccAccId(1234); // WHERE emp_acc_acc_id = 1234
     * $query->filterByEmpAccAccId(array(12, 34)); // WHERE emp_acc_acc_id IN (12, 34)
     * $query->filterByEmpAccAccId(array('min' => 12)); // WHERE emp_acc_acc_id >= 12
     * $query->filterByEmpAccAccId(array('max' => 12)); // WHERE emp_acc_acc_id <= 12
     * </code>
     *
     * @see       filterByEmpAcc()
     *
     * @param     mixed $empAccAccId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByEmpAccAccId($empAccAccId = null, $comparison = null)
    {
        if (is_array($empAccAccId)) {
            $useMinMax = false;
            if (isset($empAccAccId['min'])) {
                $this->addUsingAlias(EmpProfilePeer::EMP_ACC_ACC_ID, $empAccAccId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($empAccAccId['max'])) {
                $this->addUsingAlias(EmpProfilePeer::EMP_ACC_ACC_ID, $empAccAccId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::EMP_ACC_ACC_ID, $empAccAccId, $comparison);
    }

    /**
     * Filter the query on the fname column
     *
     * Example usage:
     * <code>
     * $query->filterByFname('fooValue');   // WHERE fname = 'fooValue'
     * $query->filterByFname('%fooValue%'); // WHERE fname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByFname($fname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fname)) {
                $fname = str_replace('*', '%', $fname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::FNAME, $fname, $comparison);
    }

    /**
     * Filter the query on the lname column
     *
     * Example usage:
     * <code>
     * $query->filterByLname('fooValue');   // WHERE lname = 'fooValue'
     * $query->filterByLname('%fooValue%'); // WHERE lname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByLname($lname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lname)) {
                $lname = str_replace('*', '%', $lname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::LNAME, $lname, $comparison);
    }

    /**
     * Filter the query on the mname column
     *
     * Example usage:
     * <code>
     * $query->filterByMname('fooValue');   // WHERE mname = 'fooValue'
     * $query->filterByMname('%fooValue%'); // WHERE mname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByMname($mname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mname)) {
                $mname = str_replace('*', '%', $mname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::MNAME, $mname, $comparison);
    }

    /**
     * Filter the query on the bday column
     *
     * Example usage:
     * <code>
     * $query->filterByBday('2011-03-14'); // WHERE bday = '2011-03-14'
     * $query->filterByBday('now'); // WHERE bday = '2011-03-14'
     * $query->filterByBday(array('max' => 'yesterday')); // WHERE bday < '2011-03-13'
     * </code>
     *
     * @param     mixed $bday The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByBday($bday = null, $comparison = null)
    {
        if (is_array($bday)) {
            $useMinMax = false;
            if (isset($bday['min'])) {
                $this->addUsingAlias(EmpProfilePeer::BDAY, $bday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bday['max'])) {
                $this->addUsingAlias(EmpProfilePeer::BDAY, $bday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::BDAY, $bday, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%'); // WHERE gender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gender The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByGender($gender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gender)) {
                $gender = str_replace('*', '%', $gender);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::GENDER, $gender, $comparison);
    }

    /**
     * Filter the query on the img_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImgPath('fooValue');   // WHERE img_path = 'fooValue'
     * $query->filterByImgPath('%fooValue%'); // WHERE img_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imgPath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByImgPath($imgPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imgPath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imgPath)) {
                $imgPath = str_replace('*', '%', $imgPath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::IMG_PATH, $imgPath, $comparison);
    }

    /**
     * Filter the query on the date_joined column
     *
     * Example usage:
     * <code>
     * $query->filterByDateJoined('2011-03-14'); // WHERE date_joined = '2011-03-14'
     * $query->filterByDateJoined('now'); // WHERE date_joined = '2011-03-14'
     * $query->filterByDateJoined(array('max' => 'yesterday')); // WHERE date_joined < '2011-03-13'
     * </code>
     *
     * @param     mixed $dateJoined The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function filterByDateJoined($dateJoined = null, $comparison = null)
    {
        if (is_array($dateJoined)) {
            $useMinMax = false;
            if (isset($dateJoined['min'])) {
                $this->addUsingAlias(EmpProfilePeer::DATE_JOINED, $dateJoined['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateJoined['max'])) {
                $this->addUsingAlias(EmpProfilePeer::DATE_JOINED, $dateJoined['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpProfilePeer::DATE_JOINED, $dateJoined, $comparison);
    }

    /**
     * Filter the query by a related EmpAcc object
     *
     * @param   EmpAcc|PropelObjectCollection $empAcc The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EmpProfileQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEmpAcc($empAcc, $comparison = null)
    {
        if ($empAcc instanceof EmpAcc) {
            return $this
                ->addUsingAlias(EmpProfilePeer::EMP_ACC_ACC_ID, $empAcc->getId(), $comparison);
        } elseif ($empAcc instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmpProfilePeer::EMP_ACC_ACC_ID, $empAcc->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEmpAcc() only accepts arguments of type EmpAcc or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmpAcc relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function joinEmpAcc($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmpAcc');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EmpAcc');
        }

        return $this;
    }

    /**
     * Use the EmpAcc relation EmpAcc object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CoreBundle\Model\EmpAccQuery A secondary query class using the current class as primary query
     */
    public function useEmpAccQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmpAcc($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmpAcc', '\CoreBundle\Model\EmpAccQuery');
    }

    /**
     * Filter the query by a related EmpContact object
     *
     * @param   EmpContact|PropelObjectCollection $empContact  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EmpProfileQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEmpContact($empContact, $comparison = null)
    {
        if ($empContact instanceof EmpContact) {
            return $this
                ->addUsingAlias(EmpProfilePeer::ID, $empContact->getEmpProfileId(), $comparison);
        } elseif ($empContact instanceof PropelObjectCollection) {
            return $this
                ->useEmpContactQuery()
                ->filterByPrimaryKeys($empContact->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmpContact() only accepts arguments of type EmpContact or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmpContact relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function joinEmpContact($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmpContact');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EmpContact');
        }

        return $this;
    }

    /**
     * Use the EmpContact relation EmpContact object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \CoreBundle\Model\EmpContactQuery A secondary query class using the current class as primary query
     */
    public function useEmpContactQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmpContact($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmpContact', '\CoreBundle\Model\EmpContactQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   EmpProfile $empProfile Object to remove from the list of results
     *
     * @return EmpProfileQuery The current query, for fluid interface
     */
    public function prune($empProfile = null)
    {
        if ($empProfile) {
            $this->addUsingAlias(EmpProfilePeer::ID, $empProfile->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
