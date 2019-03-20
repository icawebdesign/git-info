<?php

namespace Icawebdesign\GitInfo\Tests;

use Icawebdesign\GitInfo\GitInfo;
use Icawebdesign\GitInfo\Models\GitBranchEntity;
use Icawebdesign\GitInfo\Models\GitCommitEntity;
use PHPUnit\Framework\TestCase;

class GitInfoTest extends TestCase
{
    /** @var GitInfo */
    protected $gitInfo;

    public function setUp(): void
    {
        parent::setUp();

        $rootPath = __DIR__ . '/..';
        $this->gitInfo = new GitInfo($rootPath, new GitBranchEntity(), new GitCommitEntity());
    }
    /** @test */
    public function getting_branch_info_returns_the_a_git_branch_entity(): void
    {
        $branch = $this->gitInfo->branchInfo();
        $this->assertInstanceOf(GitBranchEntity::class, $branch);
    }

    /** @test */
    public function getting_commit_info_returns_a_git_commit_entity(): void
    {
        $commit = $this->gitInfo->commitInfo();
        $this->assertInstanceOf(GitCommitEntity::class, $commit);
    }
}
