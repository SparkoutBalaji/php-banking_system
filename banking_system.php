<?php
class Bank {
    private $name;
    private $accounts = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function createAccount($accountHolder, $initialBalance, $accountType) {
        $account = new $accountType($accountHolder, $initialBalance);
        $this->accounts[] = $account;
        return $account;
    }

    public function getAccountsForHolder($accountHolder) {
        $holderAccounts = [];
        foreach ($this->accounts as $account) {
            if ($account->getAccountHolder() === $accountHolder) {
                $holderAccounts[] = $account;
            }
        }
        return $holderAccounts;
    }
}

class Account {
    protected $accountNumber;
    protected $accountHolder;
    protected $balance;

    private static $nextAccountNumber = 1001;

    public function __construct($accountHolder, $initialBalance) {
        $this->accountNumber = self::$nextAccountNumber++;
        $this->accountHolder = $accountHolder;
        $this->balance = $initialBalance;
    }

    public function getAccountNumber() {
        return $this->accountNumber;
    }

    public function getAccountHolder() {
        return $this->accountHolder;
    }

    public function getBalance() {
        return $this->balance;
    }
}

class SavingsAccount extends Account { }

class CurrentAccount extends Account { }

class LoanAccount extends Account { }


$bank = new Bank("MyBank");

$savingsAccount = $bank->createAccount("BALAJI N", 1000, 'SavingsAccount');
$savingsAccount = $bank->createAccount("BALAJI N", 500, 'SavingsAccount');
$currentAccount = $bank->createAccount("HARI", 500, 'CurrentAccount');
$currentAccount = $bank->createAccount("HARI", 500, 'SavingsAccount');
$currentAccount = $bank->createAccount("PRASANTH", 500, 'SavingsAccount');
$loanAccount = $bank->createAccount("GARUNYA", 2000, 'LoanAccount');

$accountHolder = "BALAJI N";
$accounts = $bank->getAccountsForHolder($accountHolder);
$accountTypes = [];

foreach ($accounts as $account) {
    $accountTypes[] = get_class($account);
}

$accountTypesString = implode(", ", $accountTypes);

echo "Account Holder: $accountHolder<br/>";
echo "Account Types: $accountTypesString<br/>";
?>
