<?php

class Database
{
	private SQLite3 $db;

	public function __construct()
	{
		$this->db = new SQLite3('db.sqlite', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, "");

		$this->db->exec("CREATE TABLE IF NOT EXISTS books (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            category TEXT,
            price REAL NOT NULL
        )");

		if ($this->isBooksTableEmpty()) $this->insertStarterData();
	}

	private function isBooksTableEmpty(): bool
	{
		$result = $this->db->querySingle("SELECT COUNT(*) as count FROM books");
		return $result == 0;
	}

	private function insertStarterData(): void
	{
		$this->db->exec("INSERT INTO books (title, category, price) VALUES ('The Catcher in the Rye', 'Novel', 10.5)");
		$this->db->exec("INSERT INTO books (title, category, price) VALUES ('To Kill a Mockingbird', 'Novel', 12.5)");
		$this->db->exec("INSERT INTO books (title, category, price) VALUES ('1984', 'Novel', 15.5)");
		$this->db->exec("INSERT INTO books (title, category, price) VALUES ('The Great Gatsby', 'Novel', 20.5)");
	}

	public function getConnection(): SQLite3
	{
		return $this->db;
	}

	public function closeConnection(): void
	{
		$this->db->close();
	}
}