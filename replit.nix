{ pkgs }: {
  deps = [
    pkgs.php83
    pkgs.php83Packages.composer
    pkgs.php83Extensions.pdo
    pkgs.php83Extensions.pdo_pgsql
    pkgs.php83Extensions.pgsql
    pkgs.php83Extensions.mbstring
    pkgs.php83Extensions.openssl
    pkgs.php83Extensions.tokenizer
    pkgs.php83Extensions.xml
    pkgs.php83Extensions.ctype
    pkgs.php83Extensions.fileinfo
    pkgs.php83Extensions.bcmath
  ];
}
